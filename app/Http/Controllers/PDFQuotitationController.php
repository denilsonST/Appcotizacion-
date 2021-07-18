<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\RequestQuotitation; 
use App\RequestDetail;
use App\AdministrativeUnit;
use App\Faculty;
use Barryvdh\DomPDF\Facade as PDF;
//use PDF;
class PDFQuotitationController extends Controller
{
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function requestquotitationPDF($id)
    {
        $idAdministrative = RequestQuotitation::where('id',$id)->pluck('administrative_unit_id')->first();
        $idFacultad = AdministrativeUnit::where('id',$idAdministrative)->pluck('faculties_id')->first();
        $facultad = Faculty::find($idFacultad);
        $detailsQuotitations = RequestDetail::where("request_quotitations_id",$id)->get();
        $details = array();
        foreach ($detailsQuotitations as $key => $detail) {
            array_push($details,$detail);
        }
        $data=[
            'details'=>$details,
            'facultad'=>$facultad
        ];
        $pdf = PDF::loadView('quotitationv2',$data);
        //dd($pdf);
        //return $pdf->download('Postulantes.pdf');
        return $pdf->setPaper('a4', 'landscape')->stream('quotitation.pdf');
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
