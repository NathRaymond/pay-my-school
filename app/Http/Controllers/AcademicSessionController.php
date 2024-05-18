<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function App\Helpers\api_request_response;
use function App\Helpers\bad_response_status_code;
use function App\Helpers\success_status_code;
use Illuminate\Support\Facades\File;
use App\Models\AcademicSession;
use Session;

class AcademicSessionController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $acc= AcademicSession::where('school_id',auth()->user()->school_id)->orderBy('description', 'DESC')->get();
            return response()->json($acc);
        }
        return view('admin.academic_session');
    }

    public function create(Request $request)
    {
        $input = $request->all();
        //validate session whether it exist
        $existingData = AcademicSession::where('school_id',auth()->user()->school_id)->where('description', $request->description)->first();

        if ($existingData) {
            return response()->json(['message' => 'Session already exist.'], 400);
        }

        $input['school_id']= auth()->user()->school_id;
        $input['created_by']= auth()->user()->id;
        $createSession = AcademicSession::create($input);

        return response()->json(['message' => 'New session added successfully!'], 400);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        // dd($id);
        $prog = AcademicSession::where('school_id',auth()->user()->school_id)->where('id', $id)->first();
        return response()->json($prog);
    }


    public function update(Request $request)
    {
        try {

            $input = $request->all();
            $id = $request->id;
            // dd($input);
            $available = AcademicSession::where('school_id',auth()->user()->school_id)->where('description', $request->description)->where('id', '!=', $id)
                ->first();

            if ($available) {
                return response()->json(['message' => 'There is another session with this name!'], 400);

            }

            $program = AcademicSession::where('school_id',auth()->user()->school_id)->find($id);

            // dd($request->all());        

            // dd($input);
            $updateSession = $program->update($input);

            return response()->json(['message' => 'Session updated successfully'], 200);

        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);

        }
    }


    public function activate(Request $request)
    {
        $id = $request->id;
        $accSess = AcademicSession::where('school_id',auth()->user()->school_id)->where('id', $id)->first();
        //activate this session and deactivate other session
        $activateSession = $accSess->update(['active' => 1]);
        Session::put('currentSessiond', $accSess->description);
        //deactivate other sesson
        $deactivate = AcademicSession::where('school_id',auth()->user()->school_id)->where('id', '!=', $id)->update(['active' => 0]);
        return response()->json(['message' => 'Academic session activated successfully!'], 200);

    }


    public function activateSemester(Request $request)
    {
        $id = $request->id;
        $accSess = AcademicSession::where('school_id',auth()->user()->school_id)->where('id', $id)->first();
        //activate this session and deactivate other session
        //check current semester
        if ($accSess->semester == 'First Semester') {
            $activatesemester = $accSess->update(['semester' => 'Second Semester']);
        } else {
            $activatesemester = $accSess->update(['semester' => 'First Semester']);

        }

        return redirect()->back()->with('message', 'Semester changed successfully!');
    }


}
