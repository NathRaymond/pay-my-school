<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\School;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
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
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email|unique:schools,email',
            'phone' => 'required|unique:users,phone|unique:schools,phone',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return respond(false, $validator->errors(), null, 401);
        }
        try {
            DB::beginTransaction();
            $input = $request->all();
            // first insert into school registration table
            $input['slug'] = Str::slug($request->name);
            $school = School::create($input);
            $input['school_id'] = $school->id;
            //$input['user_type'] = "School";
            // dd($input);
            $input['password'] = Hash::make("password");
            // insert into user table
            $user = User::create($input);
            // lets update the school table user id with the id of the user
            $school->update(["user_id" => $user->id]);
            DB::commit();
            return respond(true, "Registration Successful", $user, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return respond(false, $e->getMessage(), null, 400);
        }
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
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        //
    }
}
