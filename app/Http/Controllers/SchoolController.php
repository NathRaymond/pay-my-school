<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\School;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Paystack;
use Yansongda\Pay\Pay;

class SchoolController extends Controller
{
    public function schoolRegister(Request $request)
    {
        return view('school.register');
    }
    public function storePayment(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email|unique:users,email|unique:schools,email',
            'phone' => 'required|unique:users,phone|unique:schools,phone',
            'address' => 'required',
            's_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'lga' => 'required|string|max:255',
        ]);

        // Save the payment details
        $input = $request->all();
        $payment = School::create($request->all());

        return response()->json(['success' => true, 'payment' => $payment]);
    }

    public function verifyPayment(Request $request)
    {
        $reference = $request->reference;

        // Verify the transaction
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY')
        ])->get('https://api.paystack.co/transaction/verify/' . $reference);

        if ($response->successful()) {
            $data = $response->json();

            if ($data['data']['status'] === 'success') {
                return response()->json(['success' => true, 'message' => 'Payment verified successfully.']);
            }
        }

        return response()->json(['success' => false, 'message' => 'Payment verification failed.']);
    }
    public function handleCallback(Request $request)
    {
        // Get the payment details from the request
        $paymentDetails = $request->all();

        // Verify the transaction using the reference from the callback data
        $reference = $paymentDetails['data']['reference'];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY')
        ])->get('https://api.paystack.co/transaction/verify/' . $reference);

        if ($response->successful()) {
            $data = $response->json();

            if ($data['data']['status'] === 'success') {
                // Payment was successful, update your database as necessary
                $payment = School::where('reference', $reference)->first();
                if ($payment) {
                    $payment->status = 'success';
                    $payment->save();
                } else {
                    // If no existing payment, create a new record
                    School::create([
                        'name' => $paymentDetails['data']['customer']['first_name'],
                        'email' => $paymentDetails['data']['customer']['email'],
                        'address' => $paymentDetails['data']['customer']['address'],
                        'phone' => $paymentDetails['data']['customer']['phone'],
                        'amount' => $paymentDetails['data']['amount'] / 100, // Paystack returns amount in kobo
                        'status' => 'success',
                        'reference' => $reference,
                    ]);
                }

                return response()->json(['success' => true, 'message' => 'Callback handled and payment verified successfully.']);
            }
        }

        // Payment verification failed
        return response()->json(['success' => false, 'message' => 'Payment verification failed.']);
    }
}