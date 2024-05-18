<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Application extends Model
{
    use HasFactory;

    // use \OwenIt\Auditing\Auditable;
    protected $guarded = [];

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function role()
    {
        return $this->belongsTo('Spatie\Permission\Models\Role', 'approval_order');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function type()
    {
        return $this->belongsTo(Application_Type::class, 'type');
    }

    public function userType()
    {
        return $this->belongsTo(Application_Type::class, 'id');
    }

    public function payments()
    {
        return $this->belongsTo(Payment::class, 'id');
    }
    public function disbursedBy()
    {
        return $this->belongsTo(User::class, 'disbursed_by');
    }


}
