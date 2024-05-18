<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($advert) {
            // Set the value for the desired column
            $advert->created_by = auth()->user()->id;
        });
    }
}
