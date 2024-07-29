<?php

namespace App\Http\Controllers;

use App\Models\SchoolFee;
use App\Models\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()){
            $acc= Term::where('school_id',auth()->user()->school_id)->orderBy('description', 'DESC')->get();
            return response()->json($acc);
        }
        return view('admin.academic_term');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        //validate Term whether it exist
        $existingData = Term::where('school_id',auth()->user()->school_id)->where('description', $request->description)->first();

        if ($existingData) {
            return response()->json(['message' => 'Term already exist.'], 400);
        }

        $input['school_id']= auth()->user()->school_id;
        $input['created_by']= auth()->user()->id;
        $createTerm = Term::create($input);

        return response()->json(['message' => 'New Term added successfully!'], 200);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        // dd($id);
        $prog = Term::where('school_id',auth()->user()->school_id)->where('id', $id)->first();
        return response()->json($prog);
    }

    public function update(Request $request)
    {
        try {

            $input = $request->all();
            $id = $request->id;
            // dd($input);
            $available = Term::where('school_id',auth()->user()->school_id)->where('description', $request->description)->where('id', '!=', $id)
                ->first();

            if ($available) {
                return response()->json(['message' => 'There is another session with this name!'], 400);

            }

            $program = Term::where('school_id',auth()->user()->school_id)->find($id);

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
        $term = Term::where('school_id',auth()->user()->school_id)->where('id', $id)->first();
        //activate this term and deactivate other term
        $activateTerm = $term->update(['active' => 1]);
        //deactivate other sesson
        $deactivate = Term::where('school_id',auth()->user()->school_id)->where('id', '!=', $id)->update(['active' => 0]);
        return redirect()->back()->with(['message' => 'Academic Term activated successfully!']);

    }




}
