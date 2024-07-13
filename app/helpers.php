<?php
// use Jenssegers\Agent\Facades\Agent;

use App\Models\AcademicSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ApplicationApprover;
use App\Models\Term;
use GuzzleHttp\Client;

function formatPhoneNumber($phoneNumber)
{
    $nigeriaPrefixes = [
        '070',
        '080',
        '081',
        '090', // Mobile prefixes
        '0700',
        '0802',
        '0803',
        '0804',
        '0805',
        '0806',
        '0807',
        '0808',
        '0809', // Mobile prefixes
        '0810',
        '0811',
        '0812',
        '0813',
        '0814',
        '0815',
        '0816',
        '0817',
        '0818',
        '0819', // Mobile prefixes
        '0902',
        '0903',
        '0904',
        '0905',
        '0906',
        '0907',
        '0908',
        '0909', // Mobile prefixes
        '07025',
        '07026',
        '07027',
        '07028',
        '07029', // Landline prefixes
        '0802',
        '0803',
        '0804',
        '0805',
        '0806',
        '0807',
        '0808',
        '0809', // Landline prefixes
        '0810',
        '0811',
        '0812',
        '0813',
        '0814',
        '0815',
        '0816',
        '0817',
        '0818',
        '0819', // Landline prefixes
        '0902',
        '0903',
        '0904',
        '0905',
        '0906',
        '0907',
        '0908',
        '0909', // Landline prefixes
        '01',
        '02',
        '03',
        '04',
        '05',
        '06',
        '07',
        '09' // Landline prefixes
    ];

    // Remove any non-digit characters from the phone number
    $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

    // Check if the phone number starts with a Nigerian prefix
    $startsWithPrefix = false;
    foreach ($nigeriaPrefixes as $prefix) {
        if (substr($phoneNumber, 0, strlen($prefix)) === $prefix) {
            $startsWithPrefix = true;
            break;
        }
    }

    // Format the phone number accordingly
    if (strlen($phoneNumber) === 11 && $startsWithPrefix) {
        // Phone number with the Nigerian prefix
        $formattedNumber = '+234' . substr($phoneNumber, 1);
    } elseif (strlen($phoneNumber) === 10 && !$startsWithPrefix) {
        // Phone number without the Nigerian prefix
        $formattedNumber = '+234' . $phoneNumber;
    } else {
        // Invalid phone number
        return [
            'status' => false,
            'message' => 'Invalid phone number',
            'data' => $phoneNumber,
        ];
    }

    return [
        'status' => true,
        'message' => 'Valid phone number',
        'data' => $formattedNumber,
    ];
}

function success_status_code()
{
    return 200;
}

function bad_response_status_code()
{
    return 400;
}
function api_request_response($status, $message, $statusCode, $data = [], $return = false, $returnArray = false)
{
    $responseArray = [
        "status" => $status,
        "message" => $message,
        "data" => $data
    ];

    $response = response()->json(
        $responseArray
    );

    if ($returnArray) {
        return $returnArray;
    }

    if ($return) {
        return $response;
    }

    header('Content-Type: application/json', true, $statusCode);

    echo json_encode($response->getOriginalContent());

    exit();
}

function generate_uuid()
{
    return \Ramsey\Uuid\Uuid::uuid1()->toString();
}

function schooldId(){
    return auth()->user()->school_id;
}


function hasConsecutiveDuplicates($array)
{
    $length = count($array);

    for ($i = 0; $i < $length - 1; $i++) {
        if ($array[$i] === $array[$i + 1]) {
            return true; // Consecutive duplicates found
        }
    }

    return false; // No consecutive duplicates found
}
function convertToUppercase($word)
{
    $words = explode(' ', $word);
    $result = '';
    foreach ($words as $word) {
        $result .= strtoupper(substr($word, 0, 1));
    }
    return $result;
    // return response()->json(['converted_word' => $result]);
}

function respond($status, $message, $data, $code)
{
    return response()->json([
        'status' => $status,
        'message' => $message,
        'data' => $data
    ], $code);
}
function getUserid()
{
    $user = Auth::user()->id;
    return $user;
}



function uploadImage($file, $path)
{
    $image_name = $file->getClientOriginalName();
    $image_name_withoutextensions = pathinfo($image_name, PATHINFO_FILENAME);
    $name = str_replace(" ", "", $image_name_withoutextensions);
    $image_extension = $file->getClientOriginalExtension();
    $file_name_extension = trim($name . '.' . $image_extension);
    $uploadedFile = $file->move(public_path($path), $file_name_extension);
    return url('/') . '/' . $path . '/' . $file_name_extension;
}

function saveApproval($application, $action, $user)
{
    ApplicationApprover::create([
        "application_id" => $application,
        "user_id" => $user,
        "action" => $action,
    ]);
}



function currentSchoolSession(){
    $currentSession = AcademicSession::where('school_id', auth()->user()->school_id)->where('active', 1)->first();
    return $currentSession;
 }
function currentSchoolTerm(){
    $currentTerm = Term::where('school_id', auth()->user()->school_id)->where('active', 1)->first();
    return $currentTerm;
 }