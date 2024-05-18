<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Models\Students;
use App\Models\Parents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentImport implements ToModel, WithBatchInserts, WithHeadingRow, WithChunkReading, WithValidation
{
    protected $class;
    protected $subclass;

    function __construct($class, $subclass)
    {
        $this->class = $class;
        $this->subclass = $subclass;
        // dd($this->class, $this->subclass);
        set_time_limit(8000000);
        ini_set('max_execution_time', '5000'); //300 seconds = 5 minutes
        ini_set('memory_limit', '1024M'); // or you could use 1G
        ini_set('upload_max_filesize', '500M'); // or you could use 1G
        // dd($position,$month,$account,$value);
    }
    public function rules(): array
    {
        Validator::extend('string_exists', function ($attribute, $value, $parameters, $validator) {
            $stringValue = (string) $value;
            // dd($stringValue);
            return DB::table('parents')->where('phone', $stringValue)->exists();
        });
        return [
            'first_name' => 'required|max:500',
            'last_name' => 'required|max:500',
            'email' => 'nullable|email',
            // 'date_of_birth' => 'nullable|date',
            'admission_number' => 'nullable|unique:App\Models\Students,student_id',
            'parent_phone_number' => [
                'required',
                'numeric',
                'digits_between:10,11',
                'string_exists', // Custom validation rule to check existence as a string
            ],
            //  'parent_phone_number' => 'required|string|digits_between:10,11|exists:parents,phone',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'first_name.required' => 'First name is required!',
            'last_name.required' => 'Last name is required!',
            // 'date_of_birth.date' => 'Date of birth is invalid!',
            'admission_number.unique' => 'This admission number belongs to another student!',
            // 'parent_phone_number.unique' => 'This phone number belongs to another parents',
            'parent_phone_number.exists' => 'This phone number is not registered by any parent ',
            'parent_phone_number.required' => 'Parent phone number is required',
            'parent_phone_number.numeric' => 'Parent phone number must be a number',
        ];
    }

    public function model(array $row)
    {
        $thisNumber = (string) $row["parent_phone_number"];
        $getParents = Parents::where('phone', $thisNumber)->first();
        $getParent = DB::table('parents')->where('phone', $thisNumber)->first();
        // dd($row["parent_phone_number"], $getParent, $thisNumber,$getParents);
        $parentId = $getParents->id;
        if (isset($row["date_of_birth"])) {
            $date = $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row["date_of_birth"])->format('Y-m-d');
        } else {
            $date = NULL;
        }
        // dd($this->subclass);
        return new Students([
            'school_id' => auth()->user()->school_id,
            'first_name' => $row["first_name"],
            'last_name' => $row["last_name"],
            'other_names' => $row["other_names"],
            'email' => $row["email"],
            'class' => $this->class,
            'sub_class' => $this->subclass,
            'gender' => $row["gender"],
            'parent_id' => $parentId,
            'date_of_birth' => $date,
            'phone' => $thisNumber,//$row["parent_phone_number"],
            'address' => $row["address"],
            'student_id' => $row["admission_number"],
            'nationality' => $row["nationality"],
            'state_of_origin' => $row["state_of_origin"],
            'local_government_area' => $row["local_government_area"],
        ]);

    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
