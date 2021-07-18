<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\SpendingUnit;
use App\AdministrativeUnit;
use App\Faculty;
use App\Role;
use Illuminate\Support\Facades\DB;
use Validator;

class SpendingUnitController extends Controller
{
    public $successStatus = 200;
    /**
     * Devuelve lista de unidades de gasto mas el respectivo administrador *s*
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spendingUnits = SpendingUnit::select('id','nameUnidadGasto','faculties_id')->get();
        foreach ($spendingUnits as $kad => $spendingUnit) {
            $facultie_id =  $spendingUnit['faculties_id'];
            $faculty = Faculty::select('nameFacultad')->where('id',$facultie_id)->first();
            $spendingUnit['faculty'] = $faculty->nameFacultad;
            //solo hay un administrador por unidad
            $useradmin = $spendingUnit->users()
                        ->where(['role_id'=>1,'role_status'=>1,'spending_unit_status'=>1,'global_status'=>1])
                        ->get();
            $valor = count($useradmin);
            if($valor==0){
                $userF = [['id'=>'','name'=>'Seleccione','lastName'=>'administrador']];
                $spendingUnit['admin'] = $userF;
            }
            else{
                if($valor==1){
                    $useradm = $useradmin[0];
                    $admin = [['id'=>$useradm->id,'name'=>$useradm->name,'lastName'=>$useradm->lastName]];
                    $spendingUnit['admin'] = $admin;
                }
            }
            $spendingUnits[$kad]=$spendingUnit;        
        }
        return response()->json(['spending_units'=> $spendingUnits],$this-> successStatus);
    }

    /**
     * Registra una unidad de gasto con/sin jefe *s*
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [ 
            'nameUnidadGasto' => 'required', 
            'faculties_id' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $spendingUnits = SpendingUnit::where('faculties_id',$request['faculties_id'])->get();
        $existenUnidadesGasto = count($spendingUnits);

        if($existenUnidadesGasto > 0)
        {
            //devuelve los datos si existen nombres de unidades de gasto iguales en una facultad
            $spendingeUnitFound = SpendingUnit::where('faculties_id',$request['faculties_id'])
                                        ->get()-> where('nameUnidadGasto',$request['nameUnidadGasto']);
            $valor = count($spendingeUnitFound);
            //devuelve mensaje si ya existe una unidad de gasto con el mismo nombre
            if($valor == 1){
                $message = 'El nombre '.$request['nameUnidadGasto'].' ya esta registrado ';
                return response()->json(['message'=>$message], 200); 
            }
            $requestSpendingUnit = $request->only('nameUnidadGasto','faculties_id');
            $spendingUnit = SpendingUnit::create($requestSpendingUnit);
            $id_user = $request['idUser'];
            if($id_user!=null){
                $user_admin_no_unit = User::find($id_user);
                //caso usuario con asignacion de rol jefe reciente 
                $admin_new = $user_admin_no_unit->roles()
                                ->where(['role_id'=>1,'role_status'=>1,'spending_unit_status'=>0,'global_status'=>1])
                                ->get();
                $admin_new_valor = count($admin_new);
                if($admin_new_valor == 1){
                    $admin_new_ru = $admin_new[0];
                    $role_user_id = $admin_new_ru->pivot->id;
                    $role_user = DB::table('role_user')
                                ->where('id',$role_user_id)
                                ->update(['spending_unit_id'=>$spendingUnit['id'],'spending_unit_status'=>1,'updated_at' => now()]);
                }
                else{
                    //caso usuario exjefe, quedo con rol pero sin unidad
                    if($admin_new_valor==0){
                        $user_admin_no_unit->roles()->attach(1,['spending_unit_id'=>$spendingUnit['id'],'spending_unit_status'=>1]);
                    }
                }
                return response()->json(['message'=> "Registro exitoso"], $this-> successStatus); 
            }
            else{ 
                return response()->json(['message'=> "Registro exitoso"], $this-> successStatus); 
            }
        }

        $requestSpendingUnit = $request->only('nameUnidadGasto','faculties_id');
        $spendingUnit = SpendingUnit::create($requestSpendingUnit);
        $id_user = $request['idUser'];
        if($id_user!=null){
            $user_admin_no_unit = User::find($id_user);
            //caso usuario con asignacion de rol jefe reciente 
            $admin_new = $user_admin_no_unit->roles()
                            ->where(['role_id'=>1,'role_status'=>1,'spending_unit_status'=>0,'global_status'=>1])
                            ->get();
            $admin_new_valor = count($admin_new);
            if($admin_new_valor == 1){
                $admin_new_ru = $admin_new[0];
                $role_user_id = $admin_new_ru->pivot->id;
                $role_user = DB::table('role_user')
                            ->where('id',$role_user_id)
                            ->update(['spending_unit_id'=>$spendingUnit['id'],'spending_unit_status'=>1,'updated_at' => now()]);
            }
            else{
                //caso usuario exjefe, quedo con rol pero sin unidad
                if($admin_new_valor==0){
                    $user_admin_no_unit->roles()->attach(1,['spending_unit_id'=>$spendingUnit['id'],'spending_unit_status'=>1]);
                }
            }
            return response()->json(['message'=> "Registro exitoso"], $this-> successStatus); 
        }
        else{ 
            return response()->json(['message'=> "Registro exitoso"], $this-> successStatus); 
        }
    }
    
    /**
     * Asigna al jefe de una unidad de gasto *s*
     *
     * @return \Illuminate\Http\Response
     */
    public function assignHeadUnit($idU,$idS)
    {
        //DESHABILITAR al jefe actual de esta unidad, si es que lo tiene
        $spendingUnit = SpendingUnit::select('id')->where('id',$idS)->first();
        $useradmin_old = $spendingUnit->users()
                        ->where(['role_id'=>1,'role_status'=>1,'spending_unit_status'=>1,'global_status'=>1])
                        ->get();
        $valor = count($useradmin_old);
        if($valor==1){
            $useradmin_old_ru = $useradmin_old[0];
            $role_usero_id = $useradmin_old_ru->pivot->id;
            $role_user1 = DB::table('role_user')
                        ->where('id',$role_usero_id)
                        ->update(['spending_unit_status'=>0,'global_status'=>0,'updated_at' => now()]);
        }
        //HABILITAR al nuevo jefe de esta unidad
        $user_admin_no_unit = User::find($idU);
        //caso usuario con asignacion de rol jefe reciente 
        $admin_new = $user_admin_no_unit->roles()
                    ->where(['role_id'=>1,'role_status'=>1,'spending_unit_status'=>0,'global_status'=>1])
                    ->get();
        $admin_new_valor = count($admin_new);
        if($admin_new_valor == 1){
            $admin_new_ru = $admin_new[0];
            $role_usern_id = $admin_new_ru->pivot->id;
            $role_user2 = DB::table('role_user')
                        ->where('id',$role_usern_id)
                        ->update(['spending_unit_id'=>$idS,'spending_unit_status'=>1,'updated_at' => now()]);
        }
        else{
            //caso usuario exjefe, quedo con rol pero sin unidad
            if($admin_new_valor==0){
                $user_admin_no_unit->roles()->attach(1,['spending_unit_id'=>$idS,'spending_unit_status'=>1]);
            }
        }
        return response()->json(['message'=> "Asignacion de jefe exitosa"], $this-> successStatus);
        //return response()->json(['message'=>true], 200);
    }

    /**
     * Asigna personal a una unidad de gasto *s*
     *
     * @return \Illuminate\Http\Response
     */
    public function assignPersonal(Request $request){
        $validator = Validator::make($request->all(), [ 
            'idUser' => 'required', 
            'idUnit' => 'required',  
            'idRol' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $arr_id_roles = $request->idRol;
        $user = User::find($request->idUser);
        foreach($arr_id_roles as $or => $id_one_rol){
            //se le puede asignar todos los roles excepto administrador del sistema y jefe de unidad
            if($id_one_rol!=1 && $id_one_rol!=2 && $id_one_rol!=3){
                $rol_user_unit = $user->roles()
                ->attach($id_one_rol,['spending_unit_id'=>$request->idUnit,'spending_unit_status'=>1]);
            }
        }
        $message = $user->name." ".$user->lastName." se agrego al personal de su unidad";    
        return response()->json(['message'=> $message], $this-> successStatus); 
    }
    
    /**
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {     
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
