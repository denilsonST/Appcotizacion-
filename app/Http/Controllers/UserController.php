<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\SpendingUnit;
use App\AdministrativeUnit;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['userName' => request('userName'), 'password' => request('password')])){
            $user = Auth::user();

            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            return response()->json(['success' => $success], $this-> successStatus);
        }
        else{
            return response()->json(['error'=>'Datos incorrectos. Por favor revise su nombre de usuario y contraseña'], 401);
        }
    }

    /**
     * Register api actualizado *s*
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request, $idRol)
    {
        $validator = Validator::make($request->all(), [
            'userName' => 'required',
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $userEncontrado = User::where('ci',$request['ci'])->get();
        $valor = count($userEncontrado);
        if($valor == 1){
            $mensge = 'La cedula de identidad '.$request['ci'].' ya esta registrada ';
            return response()->json(['message'=>$mensge], 200);
        }

        $userEncontrado = User::where('email',$request['email'])->get();
        $valor = count($userEncontrado);
        if($valor == 1){
            $mensge = 'El email '.$request['email'].' ya esta registrado';
            return response()->json(['message'=>$mensge], 200);
        }

        $userEncontrado = User::where('userName',$request['userName'])->get();
        $valor = count($userEncontrado);
        if($valor == 1){
            $mensge = 'El nombre de usuario '.$request['userName'].' ya esta registrado';
            return response()->json(['message'=>$mensge], 200);
        }

        $input = $request->all();
        $input['password'] = $input['ci'];
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        //el registro de rol es opcional, si se pasa un valor valido entonces se añade el rol
        if($idRol!=0){
            $user->roles()->attach($idRol);
        }
        return response()->json(['message'=>""], $this-> successStatus);
    }
    /**
     * details api actualizado *s* a
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        //roles activos de un usuario
        $rolesactives = $user->roles()
                        ->where('role_status',1)
                        ->where('global_status',1)
                        ->get();
        $permissions = array();
        foreach ($rolesactives as $kal => $role) {
            array_push($permissions,$role->permissions);
            $id_unit_s= $role->pivot->spending_unit_id;
            $id_unit_a= $role->pivot->administrative_unit_id;
            if($id_unit_s !=null){
                $spending_unit = SpendingUnit::find($id_unit_s);
                $role['nameUnidadGasto'] = $spending_unit->nameUnidadGasto;
            }
            else{
                $role['nameUnidadGasto'] = null;
            }
            if($id_unit_a !=null){
                $administrative_unit = AdministrativeUnit::find($id_unit_a);
                $role['nameUnidadAdministrativa'] = $administrative_unit->name;
            }
            else{
                $role['nameUnidadAdministrativa'] = null;
            }

        }
        $user['roles']=$rolesactives;
        $nameallpermissions=array();
        foreach ($permissions as $kp => $arraypermi) {
            foreach ($arraypermi as $kap => $permission) {
                array_push($nameallpermissions,$permission->namePermission);
            }
        }
        $user['permissions']=$nameallpermissions;
        return response()->json(['user' => $user], $this-> successStatus);
    }
    /**
     * permisos de usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function permissions()
    {
        $user = Auth::user();
        $roles=$user->roles;
        $permissions = array();
        foreach ($roles as $key => $role) {
            $permissions[$key]=$role->permissions;
        }
        $permi=array();
        foreach ($permissions as $key => $arraypermi) {
            foreach ($arraypermi as $key => $permission) {
                array_push($permi,$permission->namePermission);
            }
        }
        return response()->json(['permissions' => $permi], $this-> successStatus);
    }

    public function roles(){
        $user = Auth::user();
        $roles=$user->roles;
        return response()->json(['roles' => $roles], $this-> successStatus);
    }
    /**
     * Devuelve una lista de usuarios mas sus roles *s* c
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::select('id','name','lastName','ci','phone','email','direction','userName')->get();
        foreach ($users as $key =>$user)
        {
             $rolesactindexall = $user->roles()
                    ->where('role_status',1)
                    ->where('global_status',1)
                    ->get();
            $rolesactindex = $rolesactindexall->unique('id');
             $valor = count($rolesactindex);
             if($valor>1){
                $nameRol = "";
                for ($i = 0; $i < $valor; $i++)
                {
                    $rolm = $rolesactindex[$i];
                    if($i==$valor-1){
                        $nameRol = $nameRol.$rolm['nameRol'];
                    }
                    else{
                        $nameRol = $nameRol.$rolm['nameRol'].', ';
                    }
                }
                $user['userRol'] = $nameRol;
             }
             else{
                 if($valor==1 ){
                    $rold = $rolesactindex[0];
                    $user['userRol'] = $rold['nameRol'];
                 }
                 if($valor==0 ){
                    $user['userRol'] = 'Seleccionar rol';
                 }
             }
             $users[$key] = $user;
        }
        return response()->json(['users'=>$users], $this-> successStatus);
    }

    /**
     * Modificar el rol de un usuario ya registrado actualizado *s*
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRol($idUser, $idRol)
    {
        $qupdaterol = DB::table('role_user')
              ->where(['user_id'=>$idUser,'role_status'=>1,'global_status'=>1])
              ->whereBetween('role_id',[1,3])
              ->update(['role_status'=>0,'global_status'=>0,'updated_at' => now()]);
        $user = User::find($idUser);
        $user->roles()->attach($idRol);
        return response()->json(['res'=>true], $this-> successStatus);
    }

    public function verifyPasswordChange($id)
    {
        $user = User::find($id);
        $password = $user['password'];
        $ci = $user['ci'];
        return $ci;

    }
    /**
     * Devuelve una lista de usuarios con rol de jefe administrativo sin unidad *s* c
     *
     * @return \Illuminate\Http\Response
     */
    public function usersAdmiWithoutDrives()
    {
        $resp = array();
        $rol_head_admin = Role::find(2);
        //usuarios con rol de jefe administrativo
        $users_head_a = $rol_head_admin->users()->get();
         //usuarios sin duplicados
        $users =$users_head_a->unique('id');
        foreach ($users as $ksu => $user){
            $admin_new = $user->roles()
                            ->where(['role_id'=>2,'role_status'=>1,'administrative_unit_status'=>1,'global_status'=>1])
                            ->whereNotNull('administrative_unit_id')
                            ->get();
            $admin_new_valor = count($admin_new);
            if($admin_new_valor == 0){//usuarios con rol de jefe activo y sin unidad
                    $admin = ['id'=>$user->id,'name'=>$user->name,'lastName'=>$user->lastName,'1'=>$admin_new_valor];
                    array_push($resp,$admin);
                }
            //$admin_new = $user->roles()
            //                ->where(['role_id'=>2,'role_status'=>1,'administrative_unit_status'=>0,'global_status'=>1])
            //                ->whereNull('administrative_unit_id')
            //                ->get();
            //$admin_new_valor = count($admin_new);
            //if($admin_new_valor == 1){//usuarios con rol de jefe activo y sin unidad
            //    $admin = ['id'=>$user->id,'name'=>$user->name,'lastName'=>$user->lastName,'1'=>$admin_new_valor];
            //    array_push($resp,$admin);
            //}
            //else{
            //    if($admin_new_valor==0){
            //        $admin_old = $user->roles()
            //                ->where(['role_id'=>2,'role_status'=>1,'administrative_unit_status'=>0,'global_status'=>0])
            //                ->whereNotNull('administrative_unit_id')
            //                ->get();
            //        $admin_old_valor = count($admin_old);
            //        if($admin_old_valor >= 1){//usuarios con rol de jefe activo y que pertenecieron antes a una unidad
            //            $admin = ['id'=>$user->id,'name'=>$user->name,'lastName'=>$user->lastName,'2'=>$admin_old_valor];
            //            array_push($resp,$admin);
            //        }
            //    }
            //}
        }
        return response()->json(['users'=>$resp], $this-> successStatus);
    }

    /**
     * Devuelve una lista de usuarios con rol de jefe de gasto sin unidad *s* c
     *
     * @return \Illuminate\Http\Response
     */
    public function usersSpendingWithoutDrives()
    {
        $resp2 = array();
        $rol_head_spen = Role::find(1);
        //usuarios con rol de jefe de gasto
        $users_head_s = $rol_head_spen->users()->get();
        //usuarios sin duplicados
        $users =$users_head_s->unique('id');
        foreach ($users as $kdu => $user){
            $admin_new = $user->roles()
                            ->where(['role_id'=>1,'role_status'=>1,'spending_unit_status'=>1,'global_status'=>1])
                            ->whereNotNull('spending_unit_id')
                            ->get();
            $admin_new_valor = count($admin_new);
            if($admin_new_valor == 0){//usuarios con rol de jefe activo y sin unidad
                    $admin = ['id'=>$user->id,'name'=>$user->name,'lastName'=>$user->lastName];
                    array_push($resp2,$admin);
                }
            //$admin_new = $user->roles()
            //                ->where(['role_id'=>1,'role_status'=>1,'spending_unit_status'=>0,'global_status'=>1])
            //                ->whereNull('spending_unit_id')
            //                ->get();
            //$admin_new_valor = count($admin_new);
            //if($admin_new_valor == 1){//usuarios con rol de jefe activo y sin unidad
            //    $admin = ['id'=>$user->id,'name'=>$user->name,'lastName'=>$user->lastName,'id_role_user'=>$user->pivot->id,'1'=>1];
            //    array_push($resp2,$admin);
            //}
            //else{
            //    if($admin_new_valor==0){
            //        $admin_old = $user->roles()
            //                ->where(['role_id'=>1,'role_status'=>1,'spending_unit_status'=>0,'global_status'=>0])
            //                ->whereNotNull('spending_unit_id')
            //                ->get();
            //        $admin_old_valor = count($admin_old);
            //        if($admin_old_valor >= 1){//usuarios con rol de jefe activo y que pertenecieron antes a una unidad
            //            $admin = ['id'=>$user->id,'name'=>$user->name,'lastName'=>$user->lastName,'id_role_user'=>$user->pivot->id,'2'=>2];
            //            array_push($resp2,$admin);
            //        }
            //    }
            //}
        }
        return response()->json(['users'=>$resp2], $this-> successStatus);
    }

    /**
     * Devuelve todos los usuarios pertenecientes a una unidad administrativa *s* c
     *
     * @param  int  $id de unidad administrativa
     * @return \Illuminate\Http\Response
     */
    public function showUsersUnitAdministrative($id)
    {
        $administrativeUnit = AdministrativeUnit::select('id')->where('id',$id)->first();
        $users_per_a = $administrativeUnit->users()
                ->where(['role_status'=>1,'administrative_unit_status'=>1,'global_status'=>1])
                ->get();
        $users =$users_per_a->unique('id');
        foreach ($users as $key => $user) {
            $rolesactindex = $user->roles()
                    ->where('role_status',1)
                    ->where('global_status',1)
                    ->where('administrative_unit_id',$id)
                    ->get();
             $valor = count($rolesactindex);
             $nameRol = "";
             if($valor>1){
                for ($i = 0; $i < $valor; $i++){
                    $rolm = $rolesactindex[$i];
                    if($i==$valor-1){
                        $nameRol = $nameRol.$rolm['nameRol'];
                    }
                    else{
                        $nameRol = $nameRol.$rolm['nameRol'].', ';
                    }
                }
             }
             else{
                 if($valor==1 ){
                    $rold = $rolesactindex[0];
                    $nameRol = $rold['nameRol'];
                 }
             }
             $userP = ['id'=>$user->id,'name'=>$user->name,'lastName'=>$user->lastName,'ci'=>$user->ci,'phone'=>$user->phone,'roles'=>$nameRol];
             $users[$key] = $userP;
        }
        return response()->json(['users'=>$users], $this-> successStatus);
    }
    /**
     * Devuelve todos los usuarios pertenecientes a una unidad de gasto *s* c
     *
     * @param  int  $id de unidad administrativa
     * @return \Illuminate\Http\Response
     */
    public function showUsersUnitSpending($id)
    {
        $spendingUnit = SpendingUnit::select('id')->where('id',$id)->first();
        $users_per_s = $spendingUnit->users()
                ->where(['role_status'=>1,'spending_unit_status'=>1,'global_status'=>1])
                ->get();
        $users =$users_per_s->unique('id');
        foreach ($users as $key => $user) {
            $rolesactindex = $user->roles()
                    ->where('role_status',1)
                    ->where('global_status',1)
                    ->where('spending_unit_id',$id)
                    ->get();
             $valor = count($rolesactindex);
             $nameRol = "";
             if($valor>1){
                for ($i = 0; $i < $valor; $i++){
                    $rolm = $rolesactindex[$i];
                    if($i==$valor-1){
                        $nameRol = $nameRol.$rolm['nameRol'];
                    }
                    else{
                        $nameRol = $nameRol.$rolm['nameRol'].', ';
                    }
                }
             }
             else{
                 if($valor==1 ){
                    $rold = $rolesactindex[0];
                    $nameRol = $rold['nameRol'];
                 }
             }
             $userP = ['id'=>$user->id,'name'=>$user->name,'lastName'=>$user->lastName,'ci'=>$user->ci,'phone'=>$user->phone,'roles'=>$nameRol];
             $users[$key] = $userP;
        }
        return response()->json(['users'=>$users], $this-> successStatus);
    }

    /**
     * Devuelve todos los usuarios que no pertenecen a una unidad administrativa *s*
     *
     * @param  int  $id de unidad administrativa
     * @return \Illuminate\Http\Response
     */
    public function showUsersOutUnitAdministrative($id)
    {
        $users = User::select('id','name','lastName','phone')->get();
        $usersOutUnit = array();
        foreach ($users as $kuo => $user) {
             $userHaveroles = $user->roles()->get();
             $valor = count($userHaveroles);
             if($valor==0){
                array_push($usersOutUnit,$user);
             }
             else{//usuario perteneciente a la unidad
                $userWithUnit = $user->roles()
                        ->where(['administrative_unit_id'=>$id,'administrative_unit_status'=>1,'global_status'=>1])
                        ->get();
                $valort = count($userWithUnit);
                if($valort==0){
                   array_push($usersOutUnit,$user);
                }
             }
        }
        return response()->json(['users'=>$usersOutUnit], $this-> successStatus);
    }

    /**
     * Devuelve todos los usuarios que no pertenecen a una unidad de gasto *s*
     *
     * @param  int  $id de unidad administrativa
     * @return \Illuminate\Http\Response
     */
    public function showUsersOutUnitSpending($id)
    {
        $users = User::select('id','name','lastName','phone')->get();
        $usersOutUnit = array();
        foreach ($users as $kso => $user) {
             $userHaveroles = $user->roles()->get();
             $valor = count($userHaveroles);
             if($valor==0){
                array_push($usersOutUnit,$user);
             }
             else{//usuario perteneciente a la unidad
                $userWithUnit = $user->roles()
                        ->where(['spending_unit_id'=>$id,'spending_unit_status'=>1,'global_status'=>1])
                        ->get();
                $valort = count($userWithUnit);
                if($valort==0){
                   array_push($usersOutUnit,$user);
                }
             }
        }
        return response()->json(['users'=>$usersOutUnit], $this-> successStatus);
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
