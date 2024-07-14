<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\StudentClass;
use App\Exports\StudentExport;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['students'] = Student::where('school_id', auth()->user()->school_id)->orderBy('created_at', 'ASC')->get();
        $data['classes'] = StudentClass::whereNull('class_id')->get();
        return view('admin.student.view', $data);
    }

    public function downloadExcel()
    {
        $headers = [
            'First Name',
            'Last Name',
            'Other Names',
            'Email',
            'Gender',
            'Date Of Birth',
            'Address',
            'Parent Phone Number',
            'Admission Number',
            'Nationality',
            'State of Origin',
            'Local Government Area',
            'Religion'
        ];
        return Excel::download(new StudentExport($headers), 'student.xlsx');
    }

    public function upload(Request $request)
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
            \Excel::import(new StudentImport($class, $subclass), request()->file('file')->store('temp'));
            DB::commit();
            return api_request_response(
                "ok",
                "Import successful!!",
                success_status_code(),
                $countdata
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
            // dd($errorCode,$exception->getMessage(),$exception->errorInfo[2]);
            if (is_int($errorCode)) {
                return api_request_response(
                    'error',
                    $exception->errorInfo[2],
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
