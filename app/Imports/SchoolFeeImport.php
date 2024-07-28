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
    function __construct($class)
    {
        $this->class = $class;
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
            'amount' => 'required|numeric'          
        ];
    }

    public function customValidationMessages()
    {
        return [
            'description.required' => 'Description is required!',
            'amount.required' => 'Amount is required!',
            'amount.numeric' => 'Amount must be a number!',
           
        ];
    }

    public function model(array $row)
    {
        //let's check if record exist before, if exist, don't go
        $existingSchoolFee = SchoolFee::where([['school_id',auth()->user()->school_id],
        ['description',$row["description"]],['session_id', currentSchoolSession()->id],['term_id', currentSchoolTerm()->id],
        ['class_id', $this->class]       
        ])->first();
        if($existingSchoolFee){
            $description= $row["description"];
            throw new \Exception("You have uploaded a school fee named: $description for this class", 1);
            
        }
            
        return new SchoolFee([
            'school_id' => auth()->user()->school_id,
            'created_by' => auth()->user()->id,
            'description' => $row["description"],     
            'amount' => $row["amount"],     
            'class_id' => $this->class,
            'session_id' => currentSchoolSession()->id,
            'term_id' => currentSchoolTerm()->id,            
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
