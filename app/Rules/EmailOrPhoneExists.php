<?php

namespace App\Rules;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class EmailOrPhoneExists implements Rule
{
    public function passes($attribute, $value)
    {
        return User::where(function ($query) use ($value) {
                $query->where('email', $value)
                    ->orWhere('phone', $value);
                })
                ->exists();
    }

    public function message()
    {
        return 'Invalid Credentials! Retry.';
    }

}
