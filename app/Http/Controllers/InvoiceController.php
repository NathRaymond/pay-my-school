<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Invoice;
use App\Models\InvoiceBreakdown;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
     function currentSessionId(){
        $currentSession = AcademicSession::where('school_id', auth()->user()->school_id)->where('active', 1)->first();
        return $currentSession->id;
     }
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $inv = Invoice::where('school_id', auth()->user()->school_id)->where('session_id',$this->currentSessionId())->get();
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
        $sessionId = $this->currentSessionId();
        $sessionId = $this->currentSessionId();
        


    }
}
