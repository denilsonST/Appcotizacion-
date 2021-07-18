<?php

namespace App\Http\Controllers;

use App\QuoteReport;
use Illuminate\Http\Request;
use Validator;
use App\RequestQuotitation; 

class QuoteReportController extends Controller
{
    public $successStatus = 200;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        
        $validator = Validator::make($request->all(), [ 
            'description' => 'required',
            'dateReport' => 'required',
            //nombre de quien realiza el informe
            'aplicantName' => 'required', 
            'request_quotitations_id' => 'required',

        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        
        $reportFound = QuoteReport::where('request_quotitations_id',$request['request_quotitations_id'])->get();
        $valor = count($reportFound);
        
        //devuelve mensaje si la solicitud ya tiene un informe
        if($valor == 1){
            $message = 'La solicitud ya tiene un informe ';
            return response()->json(['message'=>$message], 200); 
        }
        
        $input = $request->all();
        $quoteReport = QuoteReport::create($input);
        // Se finaliza la cotizacion
        $requestQuotitation = RequestQuotitation::find($request['request_quotitations_id']);
        $requestQuotitation['statusResponse'] = 'Finalizado';
        $requestQuotitation->update();
        return response()->json(['message'=> "Registro exitoso"], $this-> successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QuoteReport  $quoteReport
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //devuelve el informe de una determinada solicitud
        $reports = quoteReport::select('description','dateReport','aplicantName')->where('request_quotitations_id',$id)->get();
        $report = $reports[0];
        return response()->json($report , $this-> successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuoteReport  $quoteReport
     * @return \Illuminate\Http\Response
     */
    public function edit(QuoteReport $quoteReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuoteReport  $quoteReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuoteReport $quoteReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuoteReport  $quoteReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuoteReport $quoteReport)
    {
        //
    }
}
