<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facade\File;
use App\RequestQuotitation; 
use App\RequestDetail; 
use App\User;
use App\SpendingUnit;
use App\LimiteAmount;
use App\AdministrativeUnit;
use App\Faculty;
use App\Report;
use Validator;
use Illuminate\Support\Facades\Storage;

class RequestQuotitationController extends Controller
{
    public $successStatus = 200;
    /**
     * Devuelve todas las solicitudes
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requestQuotitations = RequestQuotitation::all();
        return response()->json(['request_quotitations'=>$requestQuotitations],200);
    }

    /**
     * Devuelve todas las solicitudes que perteneces a esa unidad de gasto
     *
     * @return \Illuminate\Http\Response
     */
    public function showRequestQuotationGasto($id)
    {
        $requestQuotitationsGasto = RequestQuotitation::select("id","nameUnidadGasto","requestDate","status","statusResponse","spending_units_id")->where('spending_units_id','=',$id)->get();
        foreach ($requestQuotitationsGasto as $key => $requestQuotitation) {
            $id_requestQuotitation = $requestQuotitation['id'];
            //busca si el id de esta solicitud tiene un informe
            $report = Report::where('request_quotitations_id',$id_requestQuotitation)->get();
            $countReport = count($report);
            if($countReport == 1){
                $requestQuotitation['statusReport'] = true;
            }
            else{
                $requestQuotitation['statusReport'] = false;
            }
            $requestQuotitationsGasto[$key] = $requestQuotitation;
        }
        return response()->json(['request_quotitations'=>$requestQuotitationsGasto],200);
    }
    /**
     * Devuelve todas las solicitudes que perteneces a esa unidad administrativa
     *
     * @return \Illuminate\Http\Response
     */
    public function showRequestQuotationAdministrative($id)
    {
        $requestQuotitationsAdmin = RequestQuotitation::select("id","nameUnidadGasto","requestDate","status","statusResponse","administrative_unit_id")->where('administrative_unit_id','=',$id)->get();
        foreach ($requestQuotitationsAdmin as $key => $requestQuotitation) {
            $id_requestQuotitation = $requestQuotitation['id'];
            //busca si el id de esta solicitud tiene un informe
            $report = Report::where('request_quotitations_id',$id_requestQuotitation)->get();
            $countReport = count($report);
            if($countReport == 1){
                $requestQuotitation['statusReport'] = true;
            }
            else{
                $requestQuotitation['statusReport'] = false;
            }
            $requestQuotitationsAdmin[$key] = $requestQuotitation;
        }
        return response()->json(['request_quotitations'=>$requestQuotitationsAdmin],200);
    }
    /**
     * resive un solicitud para poder crear una nueva solictud 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $input = $request->only('nameUnidadGasto', 'aplicantName','requestDate','amount','spending_units_id');
        $arrayDetails = $request->only('details');
        $arrayDetails=$arrayDetails['details'];
        $validator = Validator::make($request->all(), [ 
            'nameUnidadGasto' => 'required', 
            'aplicantName' => 'required', 
            'requestDate' => 'required', 
            'amount' => 'required', 
            ]);
            if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors()], 401);            
            }
            //$idGasto = $request->only('spending_units_id');
        $idGasto = $input['spending_units_id'];
        $gasto = SpendingUnit::find($idGasto);
        $idFacultad = $gasto->faculties_id;
        $unidadadmini  = AdministrativeUnit::where('faculties_id','=',$idFacultad)->get();
        foreach ($unidadadmini as $key => $admi) {
            $input['administrative_unit_id'] = $admi->id;
        }
        $data = LimiteAmount::latest('id')->first();
        $input['limiteId']=$data->id;
        $requestQuotitation = RequestQuotitation::create($input);
        $idQuotitation = $requestQuotitation['id'];
        $countDetails = count($arrayDetails);
         for ($i = 0; $i < $countDetails; $i++)
         {
             $detailI=$arrayDetails[$i];
             $detailI['request_quotitations_id']= $idQuotitation;
             RequestDetail::create($detailI);
         }
         
         return response()->json(['success' =>$idQuotitation], $this-> successStatus);
    }
    /* public function saveFile($files , $datas){
        
        return;
    } */


    public function upload(Request $request){
        $request->file('archivo')->store('public');
    }

    public function uploadOne(Request $req,$id){
        
        $result = $req->file('file')->store('Archivos');
        return ["result"=>$result];
    } 
    public function download(Request $req){
        $path = storage_path('app\Archivos\KEr48AL1e7QHtSmq3CMhysAQK53FJvm0DpVJcROm.pdf');
        return response()->download($path);
    }


    public function uploadFile(Request $request,$id)
    {
        $files = $request->file();
        foreach ($files as $file) {
            $filename = $file->getClientOriginalName();
        
            $filename= pathinfo($filename, PATHINFO_FILENAME);
            $name_File = str_replace(" ","_",$filename);
    
            $extension = $file->getClientOriginalExtension();
    
            $name = date('His') . "-" . $name_File . "." .$extension;
            $file->move(public_path('FilesAquisicion/'.$id),$name);
        }
       
        return response()->json(["messaje"=>"Archivos guardados"]);
    }
    public function fileDowload(){
        return response()->download(public_path('Files/db.pdf'), "base de datos");
    }
    public function downloadFile($id,$namefile){
        $path = public_path('FilesAquisicion\\'.$id.'\\'.$namefile);
        //dd($path);
        return response()->download($path);

    }
    public function showFile($id,$namefile){
        $path = public_path('FilesAquisicion\\'.$id.'\\'.$namefile);
        //dd($path);
        return response()->file($path);
    }
    /**
     * devuelve el detalle de la solicitud cuando te pasan el id de la solitud
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        //devuelve datos y detalles de una solicitud
        $requestQuotitations = RequestQuotitation::all();
        $deils = RequestDetail::where('request_quotitations_id',$id)->get();
        $requestQuotitation = $requestQuotitations->find($id);
        $requestQuotitation['details'] = $deils;
        //sacar el monto estimado de la solicitud
        $amountEstimated =  $requestQuotitation['amount'];
        //sacar el monto limite
        $limitId = $requestQuotitation->limiteId;
        $limite=LimiteAmount::find($limitId);
        $requestQuotitation['limite'] = $limite;
        $montoTope = $limite->monto;
        $requestQuotitation['message'] = "";
        if( $amountEstimated > $montoTope){
            $requestQuotitation['message'] = "El monto es superior al tope";
        }
        return response()->json($requestQuotitation,200);
    }

    public function updateState(Request $request, $id)
    {
        $status = $request->only('status');
        $requestQuotitation = RequestQuotitation::find($id);
        if($status['status']=='Aceptado'){
            $requestQuotitation['statusResponse'] = 'En proceso';
        }
        if($status['status']=='Rechazado'){
            $requestQuotitation['statusResponse'] = 'Denegado';
        }
        $requestQuotitation['status'] = $status['status'];
        $requestQuotitation->update();
        return response()->json($requestQuotitation,200);
    }



      /**
     * devuelve los archivos adjuntos de una solicitud cuando te pasan el id de la solicitud
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showFiles($id)
    {
        $directory = public_path().'/FilesAquisicion'.'/'.$id;
        $listDir = $this-> dirToArray($directory);
        return response()->json($listDir,200);
    }

    
    //devuelve un arreglo de archivos de un directorio determinado $dir
    public function dirToArray($dir) {
        $listDir = array();
        if($handler = opendir($dir)) {
            while (($file = readdir($handler)) !== FALSE) {
                if ($file != "." && $file != "..") {
                    if(is_file($dir."/".$file)) {
                        $listDir[] = $file;
                    }elseif(is_dir($dir."/".$file)){
                        $listDir[$file] = $this->dirToArray ($dir."/".$file);
                    }
                }
            }
            closedir($handler);
        }
        return $listDir;
    }

//modificar falta
//id de usuario
    public function getInformation($id)
    {
        //$dates = SpendingUnit::select('spending_units.nameUnidadGasto','users.name','users.lastName')
        //->join('users','spending_units.id','=','users.spending_units_id')
        //->where('users.id','=',$id)->get();
        $user = ['name'=>'prueba','lastName'=>'prueba2','nameUnidadGasto'=>'pruebaggg'];
        //return response()->json(["User"=> $dates[0]],200);
        return response()->json(["User"=> $user],200);
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
