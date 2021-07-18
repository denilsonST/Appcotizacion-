<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Faculty;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = Faculty::all();
        return response()->json(['facultades'=>$faculties],200);
    }

    /**
     * Facultades no usadas en niguna unidad administratica
     *
     * @return \Illuminate\Http\Response
     */
    public function noUseFaculties()
    {
        $faculties = Faculty::where('inUse',0)->get();
        return response()->json(['facultades'=>$faculties],200);
    }
    /**
     * Facultades usadas en administratica
     *
     * @return \Illuminate\Http\Response
     */
    public function inUseFaculties()
    {
        $faculties = Faculty::where('inUse',1)->get();
        return response()->json(['facultades'=>$faculties],200);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $newFaculty = Faculty::create($input);
        return response()->json(['faculty'=>$newFaculty], 200);
    }

    /**
     * Display the specified resource.
     *
*/
    public function show(Faculty $faculty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit(Faculty $faculty)
    {
        //
    }


    public function update(Request $request, Faculty $faculty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
*/
    public function destroy(Faculty $faculty)

    {
        //
    }
}
