<?php

namespace App\Http\Controllers;

use App\Exports\SchoolFeeExport;
use App\Imports\SchoolFeeImport;
use App\Models\SchoolFee;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class SchoolFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

            $schoolFees = SchoolFee::where('school_id', auth()->user()->school_id)->get();
            $data['schoolFees'] = $schoolFees->groupBy('class_id');
            // dd($data);
            $data['classes'] = StudentClass::whereNull('class_id')->get();
       
        return view('admin.school-fee',$data);
    }


    public function downloadExcel()
    {
        $headers = [
            'SN',
            'Description',
            'Amount'
           
        ];
        return Excel::download(new SchoolFeeExport($headers), 'school-fee.xlsx');
    }


    public function uploadSchoolFee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xls,xlsx',
        ]);
        // dd("here");
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessage = '';
            foreach ($errors->all() as $error) {
                $errorMessage .= $error . "\n";
            }

            return api_request_response(
                'error',
                $errorMessage,
                bad_response_status_code()
            );
        }

        if(!currentSchoolSession()){
            return api_request_response(
                'error',
                'Kindly set the current academic session',
                bad_response_status_code()
            );  
        }
        if(!currentSchoolTerm()){
            return api_request_response(
                'error',
                'Kindly set the current term',
                bad_response_status_code()
            );  
        }
        $input = $request->all();
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(request()->file('file'));
        // $highestRow =  $spreadsheet->getDelegate()->getHighestColumn();
        $highestRow = $spreadsheet->getActiveSheet()->getHighestDataRow();
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        $countdata = count($sheetData) - 1;
        // dd($countdata,$request->all());
        if ($countdata < 1) {
            return api_request_response(
                "error",
                "Excel File Is Empty! Populate And Upload! ",
                bad_response_status_code(),
                $countdata
            );
        }
        $class = $request->class_id;
        $subclass = $request->sub_class_id;
        // dd($subclass);
        try {
            DB::beginTransaction();
            \Excel::import(new SchoolFeeImport($class), request()->file('file'));
            DB::commit();
            return api_request_response(
                "ok",
                "Import successful!!",
                success_status_code(),
                []
            );
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            DB::rollback();
            $failures = $e->failures();
            $errormessage = '';
            foreach ($failures as $failure) {
                $errormess = '';
                foreach ($failure->errors() as $error) {
                    $errormess = $errormess . $error;
                }
                $errormessage .= 'There was an error on Row ' . ' ' . $failure->row() . '.' . ' ' . $errormess;
            }
            //  dd($errormessage);
            return api_request_response(
                'error',
                $errormessage,
                bad_response_status_code()
            );
        } catch (\Exception $exception) {
            DB::rollback();
            $errorCode = $exception->errorInfo[1] ?? $exception;
            // dd($errorCode,$exception->getMessage());
            if (is_int($errorCode)) {
                return api_request_response(
                    'error',
                    $errorCode,
                    bad_response_status_code()
                );
            } else {
                // dd($exception);
                return api_request_response(
                    'error',
                    $exception->getMessage(),
                    bad_response_status_code()
                );
            }
        }
    }
    

    public function details($id){
        $data['schoolFees']= SchoolFee::where('class_id',$id)->get();
        return view('admin.school-fee-details',$data);
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
    public function update($id)
    {
        
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolFee  $schoolFee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $schoolFee = SchoolFee::find($request->id);
        $deleteFee = $schoolFee->delete();
        return redirect()->back()->with('message', 'School Fee deleted successfully');
    }
}
