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
    public function index()
    {
        $data['academic_sessions'] = AcademicSession::orderBy('description', 'DESC')->get();
        return view('admin.academic_session', $data);
    }

    public function create(Request $request)
    {
        $input = $request->all();
        //validate session whether it exist
        $existingData = AcademicSession::where('description', $request->description)->first();

        if ($existingData) {
            return response()->json(['message' => 'Session already exist.'], 400);
        }

        // dd($input);
        $createSession = AcademicSession::create($input);

        return response()->json(['message' => 'New session added successfully!'], 400);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        // dd($id);
        $prog = AcademicSession::where('id', $id)->first();
        return response()->json($prog);
    }


    public function update(Request $request)
    {
        try {

            $input = $request->all();
            $id = $request->id;
            // dd($input);
            $available = AcademicSession::where('description', $request->description)->where('id', '!=', $id)
                ->first();

            if ($available) {
                return response()->json(['message' => 'There is another session with this name!'], 400);

            }

            $program = AcademicSession::find($id);

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
        $accSess = AcademicSession::where('id', $id)->first();
        //activate this session and deactivate other session
        $activateSession = $accSess->update(['active' => 1]);
        Session::put('currentSessiond', $accSess->description);
        //deactivate other sesson
        $deactivate = AcademicSession::where('id', '!=', $id)->update(['active' => 0]);
        return response()->json(['message' => 'Academic session activated successfully!'], 200);

    }


    public function activateSemester(Request $request)
    {
        $id = $request->id;
        $accSess = AcademicSession::where('id', $id)->first();
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
