<?php

namespace App\Validators;

class UserValidator extends RequestValidator
{
    public function getRules(): array
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'nullable|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|max:255',
            'type' => 'required|in:employee'
        ];
    }
}