<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function invoiceIndex()
    {
        $data['Invoice'] = Invoice::where('school_id', auth()->user()->school_id)->get();
    }
}