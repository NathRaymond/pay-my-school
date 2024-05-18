<?php

namespace App\Rules;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class AdminLogin implements Rule
{
    public function passes($attribute, $value)
    {
        return User::where('user_type','Admin')
        ->where(function ($query) use ($value) {
                $query->where('email', $value)
                    ->orWhere('phone_number', $value);
                })
                ->exists();
    }

    public function message()
    {
        return 'Invalid Credentials! Retry.';
    }
}
