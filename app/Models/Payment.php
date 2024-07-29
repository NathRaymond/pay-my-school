<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use OwenIt\Auditing\Contracts\Auditable;

class Payment extends Model
{
    use HasFactory;
    //use \OwenIt\Auditing\Auditable;
    protected $table = 'payments';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function userType()
    {
        return $this->belongsTo(Application_Type::class, 'type');
    }
    public function applications()
    {
        return $this->belongsTo(Application::class, 'user_id');
    }

    public function disbursed_by()
    {
        return $this->belongsTo(Application::class, 'disbursed_by');
    }
}