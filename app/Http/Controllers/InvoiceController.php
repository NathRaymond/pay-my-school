<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Invoice;
use App\Models\InvoiceBreakdown;
use App\Models\SchoolFee;
use App\Models\Student;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
     
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $inv = Invoice::where('school_id', auth()->user()->school_id)->where('session_id',currentSchoolSession()->id)->get();
            return response()->json($inv);
        }
        return view('admin.invoice');
    }
    public function show(Request $request)
    {
        $inv = InvoiceBreakdown::where('school_id', auth()->user()->school_id)->where('invoice_id', $request->invoice_id)->get();
        return response()->json($inv);
    }
    public function generateInvoice(Request $request){
        $sessionId = currentSchoolSession()->id;
        $termId= currentSchoolTerm()->id;   
        $classId= $request->class_id;
        
        //check the SchoolFees table
        $currentSchoolFees = SchoolFee::where('session_id', $sessionId)->where('term_id', $termId)->get();
        
        //get student of this class
        $students = Student::where('class_id', $classId)->get();

        //initiate an empty array
        $InvoicesArray = [];

        //iterate each student with the appro
        $invoiceDetailsArray = [];
        foreach ($students as $key => $student) {
            //generate invoice detail
            $uuid = generate_uuid();
            //generate invoice breakdown
            foreach ($currentSchoolFees as $key => $fee) {
                //uuid has tired the invoice and breakdown together
                $invDetailInput['invoice_id']=0;
                $invDetailInput['uuid']=$uuid;
                $invDetailInput['term_id']=$termId;
                $invDetailInput['school_id']=schooldId();
                $invDetailInput['session_id']=$sessionId;
                $invDetailInput['student_id']=$student->id;
                $invDetailInput['description']=$fee->description;
                $invDetailInput['payment_status']='pending';
                $invDetailInput['created_at']=now();
                $invDetailInput['updated_at']=now();
                $invDetailInput['created_by']=auth()->user()->id;
                # code...
                //push the input into the array
                array_push($invoiceDetailsArray,$invDetailInput);

            }

            //generate invoice
            $invoiceInput['student_id'] = $student->id;
            $invoiceInput['school_id'] = schooldId();
            $invoiceInput['session_id'] = $sessionId;
            $invoiceInput['term_id'] = $termId;
            $invoiceInput['uuid'] = $uuid;
            $invoiceInput['payment_status']='pending';
            $invoiceInput['created_at']=now();
            $invoiceInput['updated_at']=now();
            $invoiceInput['created_by'] = auth()->user()->id;
            $invoiceInput['total_amount']=$currentSchoolFees->sum('amount');

            array_push($InvoicesArray,$invoiceInput);
        }

        //we have been able to manage memory and time
        $insertInvoice = Invoice::insert($InvoicesArray);
        $insertInvoiceBreakDown = Invoice::insert($InvoicesArray);

        return redirect()->back()->with('message', 'Invoices generated successfully for this class');
             



    }

    
}
