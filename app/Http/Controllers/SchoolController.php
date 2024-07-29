<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\School;
use App\Models\Country;
use App\Models\State;
use App\Models\LGA;
use App\Models\Amount;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Paystack;
use Yansongda\Pay\Pay;
use Carbon\Carbon;

class SchoolController extends Controller
{
    public function showForm()
    {
        $data['countries'] = Country::all();
        $data['states'] = State::all();
        $data['lgas'] = LGA::all();
        $data['amounts'] = Amount::all();
        return view('school.register', $data);
    }

    public function registerSchool(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email|unique:users,email|unique:schools,email',
            'phone' => 'required|unique:users,phone|unique:schools,phone|numeric|digits:11',
            'address' => 'required',
            'name' => 'required|string|max:255',
            'p_name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'lga' => 'required|string|max:255',
            'amount' => 'required|numeric',
        ]);

        try {
            // Save in school table
            $schoolData = $request->all();
            $school = School::create($schoolData);

            // Redirect to payment page with the school ID
            return redirect()->route('payment.page', ['id' => $school->id]);
        } catch (\Exception $exception) {
            Log::error('Registration error: ' . $exception->getMessage());
            return back()->with('error', 'An error occurred: ' . $exception->getMessage());
        }
    }

    public function showPaymentPage($id)
    {
        $school = School::findOrFail($id);
        return view('school.payment_page', compact('school'));
    }

    public function verifyPayment(Request $request)
    {
        $request->validate([
            'reference' => 'required|string',
            'school_id' => 'required|exists:schools,id',
        ]);

        try {
            $school = School::findOrFail($request->school_id);
            $reference = $request->reference;

            // Verify the transaction
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY')
            ])->get('https://api.paystack.co/transaction/verify/' . $reference);

            if ($response->successful()) {
                $data = $response->json();

                if ($data['data']['status'] === 'success') {
                    // Save in user table if payment is successful
                    $userData = [
                        'name' => $school->name,
                        'email' => $school->email,
                        'phone' => $school->phone,
                        'address' => $school->address,
                        'school_id' => $school->id,
                    ];
                    User::create($userData);
                    $id = $request->school_id;
                    $reference = $request->reference;
                    $request = School::where('id', $id)->update(['reference' => $reference]);

                    return response()->json(['success' => true, 'message' => 'Payment verified and records saved successfully.', 'redirect_url' => route('login')]);
                } else {
                    return response()->json(['success' => false, 'message' => 'Payment verification failed: ' . $data['data']['gateway_response']]);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'Payment verification failed: Unable to reach payment gateway.']);
            }
        } catch (\Exception $exception) {
            Log::error('Payment verification error: ' . $exception->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $exception->getMessage()]);
        }
    }
}