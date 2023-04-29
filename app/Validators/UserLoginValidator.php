<?php

namespace App\Validators;

class UserLoginValidator extends RequestValidator
{
    public function getRules(): array
    {
        return [
            'email' => 'required|max:255',
            'password' => 'required|max:255'
        ];
    }
}