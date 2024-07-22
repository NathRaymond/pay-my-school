<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Models\SchoolFee;
use App\Models\Parents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;

class SchoolFeeImport implements ToModel, WithBatchInserts, WithHeadingRow, WithChunkReading, WithValidation
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
      
        return [
            'description' => 'required|max:500',
            'amount' => 'required|numeric|max:500'          
        ];
    }

    public function customValidationMessages()
    {
        return [
            'description.required' => 'First name is required!',
           
        ];
    }

    public function model(array $row)
    {
       
      
        // dd($this->subclass);
        return new SchoolFee([
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
