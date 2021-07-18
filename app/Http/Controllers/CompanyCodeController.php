<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CompanyCode;
use App\RequestDetail;
use App\Business;
class CompanyCodeController extends Controller
{
    /**
     * Resive el codigo y busca si existe en caso de que si devuelve todos los detalles 
     *
     * @return \Illuminate\Http\Response
     */
    public function searchCode(Request $request)
    {
        $code = $request->only('code');
        $companyCode = CompanyCode::where('code',$code)->get();
        //dd($companyCode);
        $valor = count($companyCode);
        if($valor==1){
            $company = $companyCode[0];
            $company['status']=true;
            $empresa = Business::where('email',$company->email)->get();
           $existeEmpresa = count($empresa);
           if($existeEmpresa>0){
               $company['empresa']= $empresa[0];
           }
            return response()->json($company, 200); 
        }else{
            $companyCode['status']=false;
            return response()->json($companyCode, 200);
        }
    }
    /**
     * Devuelve los detalles de la cotizacion.
     *
     * @return \Illuminate\Http\Response
     */
    public function detailsQuptitations($id)
    {
        $detalles = RequestDetail::where('request_quotitations_id',$id)->get();
        return response()->json($detalles, 200); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show(Request $request, $id)
    {
        $coder = $request->only('code');
        $code = $coder['code'];
        $companycode = CompanyCode::find($code);
        $requestQuotitation_id = $companycode['request_quotitations_id'];
        $deils = RequestDetail::where('request_quotitations_id',$requestQuotitation_id)->get();
        $companycode['details'] = $deils;
        //return response()->json($requestQuotitation,200);
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
}