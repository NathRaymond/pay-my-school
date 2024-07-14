<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Models\Student;
use App\Models\Parents;
use App\Models\AcademicSession;
use App\Models\Term;
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
        return [
            'first_name' => 'required|max:500',
            'last_name' => 'required|max:500',
            'email' => 'nullable|email',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'first_name.required' => 'First name is required!',
            'last_name.required' => 'Last name is required!',
        ];
    }

    public function model(array $row)
    {
        $term = Term::where('school_id', auth()->user()->school_id)->where('active', 1)->first();
        $session = AcademicSession::where('active', 1)->where('school_id', auth()->user()->school_id)->first();
        return new Student([
            'school_id' => auth()->user()->school_id,
            'first_name' => $row["first_name"],
            'last_name' => $row["last_name"],
            'other_name' => $row["other_names"],
            'email' => $row["email"],
            'class_id' => $this->class,
            'sub_class_id' => $this->subclass,
            'term_id' => $term->id ?? NULL,
            'session_id' => $session->id ?? NULL,
            'gender' => $row["gender"],
            'date_of_birth' =>  $row["date_of_birth"],
            'phone' => $row["parent_phone_number"],
            'address' => $row["address"],
            'admission_number' => $row["admission_number"],
            'country' => $row["nationality"],
            'state' => $row["state_of_origin"],
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
