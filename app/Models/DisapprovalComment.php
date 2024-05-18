<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisapprovalComment extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($description) {
            // Set the value for the 'status' column
            $description->disapproved_by = Auth::user()->id;

        });

    }
}
