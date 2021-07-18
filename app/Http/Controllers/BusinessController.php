<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Business;
use Validator;

class BusinessController extends Controller
{
    //
    public $successStatus = 200;
    /**
     * Devuelve una lista de empresas
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requestBusiness = Business::all();
        return response()->json(['business'=> $requestBusiness],$this-> successStatus);
    }

    /**
     * Registra una nueva empresa
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $validator = Validator::make($request->all(), [ 
        'nameEmpresa' => 'required',
        'nit' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'direction' => 'required',
        'rubro' => 'required',
    ]);
    if ($validator->fails()) { 
        return response()->json(['error'=>$validator->errors()], 401);            
    }

    $emailFound = Business::where('email',$request['email'])->get();
    $valor = count($emailFound);
    
    if($valor == 1){
        $message = 'El correo '.$request['email'].' ya esta registrado';
        return response()->json(['message'=>$message], 200); 
    }
        $input = $request->all(); 
        $business = Business::create($input); 
        return response()->json(['message'=> "Registro exitoso!"], $this-> successStatus); 
    }

     /**
     * Busca empresas segun el rubro
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchRubro(Request $request)
    { 
        $validator = Validator::make($request->all(), [ 
        'rubro' => 'required',
    ]);
    if ($validator->fails()) { 
        return response()->json(['error'=>$validator->errors()], 401);            
    }
    $rubro = $request['rubro'];
    $empresasRubro = Business::select("id","nameEmpresa","nit","email","phone","direction","rubro")->where('rubro','like',"%$rubro%")->get();
    return response()->json(['business'=> $empresasRubro], $this-> successStatus); 
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
