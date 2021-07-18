<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use Validator;

class RoleController extends Controller
{
    public $successStatus = 200;
    /**
     * Devuelve lista de roles *s*
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requestRols = Role::select('id','nameRol','description')->get();
        foreach($requestRols as $kr => $rol){
            $permisos = $rol->permissions()->get();
            $permissions = array();
            foreach($permisos as $kp => $perm){
                $id_perm = $perm->id;
                array_push($permissions,$id_perm);
            }
            $rol['permissions'] = $permissions;
        }
        return response()->json(['roles'=> $requestRols],$this-> successStatus);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $validator = Validator::make($request->all(), [ 
        'nameRol' => 'required',
        'description' => 'required', 
        
    ]);
    if ($validator->fails()) { 
        return response()->json(['error'=>$validator->errors()], 401);            
    }

    $rolFound = Role::where('nameRol',$request['nameRol'])->get();
    $valor = count($rolFound);
    
    if($valor == 1){
        $message = 'El rol '.$request['nameRol'].' ya esta registrado ';
        return response()->json(['message'=>$message], 200); 
    }
        $input = $request->all(); 
        $rol = Role::create($input); 
        $rol->permissions()->attach($input['permissions']);
        return response()->json(['message'=> "Registro exitoso"], $this-> successStatus); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rol = Role::find($id);
        return response()->json($rol, $this-> successStatus);
    }

    /**
     * Edita los permisos que tiene un rol *s*
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePermissionsOfRol(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'idRol' => 'required',
            'idPermission' => 'required', //se debe mandar si se quiere editar los permisos de ese rol
            'description' => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $arr_permission = $request->idPermission;
        $tam = count($arr_permission);
        if($tam>0){
            $rol = Role::find($request->idRol);
            $rol->description = $request->description;
            $rol->save();
            $rol->permissions()->sync($arr_permission);
            return response()->json(['message'=> "Actualizacion exitosa"], $this-> successStatus); 
        }
        else{
            return response()->json(['message'=> "No se cambio los permisos de este rol, no mando permisos"], $this-> successStatus);
        }   
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
