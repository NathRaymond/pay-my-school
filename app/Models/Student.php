<?php

namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($school) {
            // Set the value for the desired column
            $school->school_id = Auth::user()->school_id;
        });
    }

    public function sub()
    {
        return $this->belongsTo('App\Models\StudentClass', 'sub_class_id');
    }
    public function class()
    {
        return $this->belongsTo('App\Models\StudentClass', 'class_id');
    }
    public function term()
    {
        return $this->belongsTo('App\Models\Term', 'term_id');
    }
    public function session()
    {
        return $this->belongsTo('App\Models\AcademicSession', 'session_id');
    }
}
