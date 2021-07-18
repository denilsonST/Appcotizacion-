<?php

namespace App\Http\Controllers;

use App\LimiteAmount;
use Illuminate\Http\Request;
use Validator;

class LimiteAmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $successStatus = 200;

    public function index()
    {
        $limiteAmount = LimiteAmount::all();
        return response()->json(['limit_amout'=> $limiteAmount],$this-> successStatus);
    }

   /*actualiza un monto limite, guarda la fecha inicio del monto actual en la fecha fin
   del anterior monto*/
   
    public function updateLimiteAmount(Request $request)
    {
        
        $validator = Validator::make($request->all(), [ 
            'monto' => 'required', 
            'starDate' => 'required', 
            'steps' => 'required',
            'administrative_units_id' => 'required',
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $montos = LimiteAmount::where('administrative_units_id',$request['administrative_units_id'])->get();
        $existenMontos = count($montos);

        if($existenMontos > 0)
        {

          $montosIguales = LimiteAmount::where('administrative_units_id',$request['administrative_units_id'])
                                       ->latest()->take(1)->get()-> where('monto',$request['monto']);
          $valor = count($montosIguales);
          if($valor == 1){
              $message = 'El monto '.$request['monto'].' ya esta registrado ';
              return response()->json(['message'=>$message], 200); 
          }
        
          $endDate = $request['starDate'];

          $ultimoMontoActualizado = LimiteAmount::where('administrative_units_id',$request['administrative_units_id'])
          ->latest()->take(1)->update(['endDate'=>$endDate]);

          $input = $request->all(); 
          $limiteAmount = LimiteAmount::create($input);
          return response()->json(['limiteAmount'=>$limiteAmount],200);
          
        }

        
        $input = $request->all(); 
        $limiteAmount = LimiteAmount::create($input);
        return response()->json(['limiteAmount'=>$limiteAmount],200);

    }



    // muestra el ultimo registro de los montos limites
    public function sendCurrentData($id)
    {
        $currentLimiteAmount = LimiteAmount::select('monto','steps')->where('administrative_units_id',$id)->latest()->take(1)->get();
        return response()->json(['current_limit_amount'=>$currentLimiteAmount],200);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LimiteAmount  $limiteAmount
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $limiteAmount = LimiteAmount::where('administrative_units_id',$id)->get();
        return response()->json(['Limite_Amounts'=>$limiteAmount],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LimiteAmount  $limiteAmount
     * @return \Illuminate\Http\Response
     */
    public function edit(LimiteAmount $limiteAmount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LimiteAmount  $limiteAmount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LimiteAmount $limiteAmount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LimiteAmount  $limiteAmount
     * @return \Illuminate\Http\Response
     */
    public function destroy(LimiteAmount $limiteAmount)
    {
        //
    }
}
