<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolFee extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function mystudentClass()
    {
        return $this->belongsTo(StudentClass::class, 'class_id');
    }
    public function SchoolSession()
    {
        return $this->belongsTo(AcademicSession::class, 'session_id');
    }
    public function SchoolTerm()
    {
        return $this->belongsTo(Term::class, 'term_id');
    }
}
