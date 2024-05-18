<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Application_Type extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "application_types";
}
