<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;
    protected $table = "mda_archive";

    public function getFileAttribute($value)
    {
        return url('/archive/' . $value);;
    }
}
