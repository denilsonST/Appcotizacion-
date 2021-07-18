<?php

namespace App\Http\Controllers;

use App\AdministrativeUnit;
use App\Faculty;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Validator;

class AdministrativeUnitController extends Controller
{
    public $successStatus = 200;
    /**
     * Devuelve lista de unidades administrativas mas el respectivo administrador *s*
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $administrativeUnits = AdministrativeUnit::select('id','name','faculties_id')->get();
        foreach ($administrativeUnits as $kad => $administrativeUnit) {
            $facultie_id =  $administrativeUnit['faculties_id'];
            $faculty = Faculty::select('nameFacultad')->where('id',$facultie_id)->first();
            $administrativeUnit['faculty'] = $faculty->nameFacultad;
            //solo hay un administrador por unidad
            $useradmin = $administrativeUnit->users()
                        ->where(['role_id'=>2,'role_status'=>1,'administrative_unit_status'=>1,'global_status'=>1])
                        ->get();
            $valor = count($useradmin);
            if($valor==0){
                $userF = [['id'=>'','name'=>'Seleccione','lastName'=>'administrador']];
                $administrativeUnit['admin'] = $userF;
            }
            else{
                if($valor==1){
                    $useradm = $useradmin[0];
                    $admin = [['id'=>$useradm->id,'name'=>$useradm->name,'lastName'=>$useradm->lastName]];
                    $administrativeUnit['admin'] = $admin;
                }
            }
            $administrativeUnits[$kad]=$administrativeUnit;        
        }
        return response()->json(['Administrative_unit'=>$administrativeUnits],$this-> successStatus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Registra una unidad administrativa con/sin jefe *s*
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            
            'name' => 'required', 
            'faculties_id' => 'required', 

        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $id_facultad = $request['faculties_id'];
        $facultad = Faculty::find($id_facultad);
        //no permite registrar mas de una unidad dentro de la misma facultad
        if($facultad['inUse'] ==1){
              $message = 'La facultad '.$facultad['nameFacultad'].' ya tiene una unidad administrativa ';
              return response()->json(['message'=>$message], 200); 
        }
        $facultad['inUse']=1;
        $facultad->save();
        $requestAdminUnit = $request->only('name','faculties_id');
        $administrativeUnit = AdministrativeUnit::create($requestAdminUnit);
        $id_user = $request['idUser'];
        //si se le manda el id del usuario entonces registra a ese usuario como administrador de la unidad creada
        if($id_user!=null){
               $user_admin_no_unit = User::find($id_user);
               //caso usuario con asignacion de rol jefe reciente 
               $admin_new = $user_admin_no_unit->roles()
                            ->where(['role_id'=>2,'role_status'=>1,'administrative_unit_status'=>0,'global_status'=>1])
                            ->get();
                $admin_new_valor = count($admin_new);
                if($admin_new_valor == 1){
                    $admin_new_ru = $admin_new[0];
                    $role_user_id = $admin_new_ru->pivot->id;
                    $role_user = DB::table('role_user')
                                ->where('id',$role_user_id)
                                ->update(['administrative_unit_id'=>$administrativeUnit['id'],'administrative_unit_status'=>1,'updated_at' => now()]);
                }
                else{
                    //caso usuario exjefe, quedo con rol pero sin unidad
                    if($admin_new_valor==0){
                        $user_admin_no_unit->roles()->attach(2,['administrative_unit_id'=>$administrativeUnit['id'],'administrative_unit_status'=>1]);
                    }
                }
               return response()->json(['message'=> "Registro exitoso"], $this-> successStatus); 
        }
        else{
                return response()->json(['message'=>"Registro exitoso"], $this-> successStatus);
        }
    }

    /**
     * Asigna al jefe de una unidad administrativa *s*
     *
     * @return \Illuminate\Http\Response
     */
    public function assignHeadUnit($idU,$idA)
    {
        //DESHABILITAR al jefe actual de esta unidad, si es que lo tiene
        $administrativeUnit = AdministrativeUnit::select('id')->where('id',$idA)->first();
        $useradmin_old = $administrativeUnit->users()
                        ->where(['role_id'=>2,'role_status'=>1,'administrative_unit_status'=>1,'global_status'=>1])
                        ->get();
        $valor = count($useradmin_old);
        if($valor==1){
            $useradmin_old_ru = $useradmin_old[0];
            $role_usero_id = $useradmin_old_ru->pivot->id;
            $role_user1 = DB::table('role_user')
                        ->where('id',$role_usero_id)
                        ->update(['administrative_unit_status'=>0,'global_status'=>0,'updated_at' => now()]);
        }
        //HABILITAR al nuevo jefe de esta unidad
        $user_admin_no_unit = User::find($idU);
        //caso usuario con asignacion de rol jefe reciente 
        $admin_new = $user_admin_no_unit->roles()
                    ->where(['role_id'=>2,'role_status'=>1,'administrative_unit_status'=>0,'global_status'=>1])
                    ->get();
        $admin_new_valor = count($admin_new);
        if($admin_new_valor == 1){
            $admin_new_ru = $admin_new[0];
            $role_usern_id = $admin_new_ru->pivot->id;
            $role_user2 = DB::table('role_user')
                        ->where('id',$role_usern_id)
                        ->update(['administrative_unit_id'=>$idA,'administrative_unit_status'=>1,'updated_at' => now()]);
        }
        else{
            //caso usuario exjefe, quedo con rol pero sin unidad
            if($admin_new_valor==0){
                $user_admin_no_unit->roles()->attach(2,['administrative_unit_id'=>$idA,'administrative_unit_status'=>1]);
            }
        }
        return response()->json(['message'=> "Asignacion de jefe exitosa"], $this-> successStatus);
        //return response()->json(['message'=>true], 200);
    }

    /**
     * Asigna personal a una unidad administrativa *s*
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
        foreach($arr_id_roles as $jor => $id_one_rol){
            //se le puede asignar todos los roles excepto administrador del sistema y jefe de unidad
            if($id_one_rol!=1 && $id_one_rol!=2 && $id_one_rol!=3){
                $rol_user_unit = $user->roles()
                ->attach($id_one_rol,['administrative_unit_id'=>$request->idUnit,'administrative_unit_status'=>1]);
            }
        }
        $message = $user->name." ".$user->lastName." se agrego al personal de su unidad";    
        return response()->json(['message'=> $message], $this-> successStatus); 
    }

    public function getAdmiUser($idUnit)
    {
        
        $admi = User::select('id','name','lastName')->where('administrative_units_id',$idUnit)->get();
        $admis = count($admi);
        if($admis>0)
        {
           return response()->json(["User"=> $admi],200);
        }
        else
        {
            $message = 'La unidad administrativa aun no cuenta con un administrador  ';
            return response()->json(['message'=>$message], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\AdministrativeUnit  $administrativeUnit
     * @return \Illuminate\Http\Response
     */
    public function show(AdministrativeUnit $administrativeUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdministrativeUnit  $administrativeUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(AdministrativeUnit $administrativeUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdministrativeUnit  $administrativeUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdministrativeUnit $administrativeUnit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdministrativeUnit  $administrativeUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdministrativeUnit $administrativeUnit)
    {
        //
    }
}
