<?php

namespace App\Http\Controllers;

use App\Models\SchoolFee;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class SchoolFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $schoolFees = SchoolFee::where('school_id', auth()->user()->school_id)->where('session_id',currentSchoolSession()->id)->get();
            return response()->json($schoolFees);
        }
        $data['classes'] = StudentClass::whereNull('class_id')->get();
        return view('admin.school-fee',$data);
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
     * @param  \App\Models\SchoolFee  $schoolFee
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolFee $schoolFee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolFee  $schoolFee
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolFee $schoolFee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SchoolFee  $schoolFee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolFee $schoolFee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolFee  $schoolFee
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolFee $schoolFee)
    {
        //
    }
}
