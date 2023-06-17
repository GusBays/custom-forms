<?php

namespace App\Validators;

class UserPasswordRecoverValidator extends RequestValidator
{
    public function getRules(): array
    {
        return [
            'email' => 'required|max:255|exists:users,email'
        ];
    }
}