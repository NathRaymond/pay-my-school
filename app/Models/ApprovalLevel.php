<?php

namespace App\Models;

use App\Models\Role;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ApprovalLevel extends Model
{

    protected $table = 'approval_level';
    protected $fillable = [
        'module',
        'list_of_approvers'
    ];
    protected static function boot()
    {
        parent::boot();
        static::saving(function ($budget) {
            // dd('Event Fired');
            // $budget->company_id = Auth::user()->company_id;
            // $budget->created_by = Auth::user()->id;
        });
    }

    public function name()
    {
        return $this->belongsTo('App\Models\Module', 'module');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Define the relationship with the Module model
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
