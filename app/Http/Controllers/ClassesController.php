<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Classes;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $school_id = auth()->user()->school_id;
        $data['classes'] = StudentClass::where('school_id', $school_id)->whereNull('class_id')->get();
        return view('admin.class.index', $data);
    }
    public function subClassIndex()
    {
        $school_id = auth()->user()->school_id;
        $data['classes'] = StudentClass::where('school_id', $school_id)->get();
        return view('admin.class.sub', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
           $school_id = auth()->user()->school_id;
            $input = $request->all();
            // dd($input);
            $input['school_id'] = Auth::user()->id;
            // dd($input);
            if (StudentClass::where ('school_id',$school_id)->where('name', $request->name)->first()) {
                throw new \Exception("This class already exist, please create another class!");
            }
            $class = StudentClass::create($input);

            return api_request_response(
                "ok",
                "Operation Successful!",
                success_status_code(),
                $class
            );
        } catch (\Exception $exception) {
            return api_request_response(
                "error",
                $exception->getMessage(),
                bad_response_status_code()
            );
        }
    }
    public function createSubClass(Request $request)
    {
        try {
           $school_id = auth()->user()->school_id;
            $input = $request->all();
            // dd($input);
            $input['school_id'] = Auth::user()->id;
            // dd($input);
            if (StudentClass::where ('school_id',$school_id)->where('name', $request->name)->where('class_id', $request->class_id)->first()) {
                throw new \Exception("This sub class already exist, please create another class!");
            }
            $class = StudentClass::create($input);

            return api_request_response(
                "ok",
                "Operation Successful!",
                success_status_code(),
                $class
            );
        } catch (\Exception $exception) {
            return api_request_response(
                "error",
                $exception->getMessage(),
                bad_response_status_code()
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getSubClasses(Request $request)
    {
       // dd($request->id);
       $pp['data'] = $info = StudentClass::where('class_id', $request->id)->get();
       return json_encode($pp);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $classes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classes $classes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $classes)
    {
        //
    }
}
