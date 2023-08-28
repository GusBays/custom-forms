<?php

namespace App\Validators;

class UserValidator extends RequestValidator
{
    public function getRules(): array
    {
        if ($this->isUpdate) $emailRule = 'required';
        else $emailRule = 'required|unique:users';

        return [
            'first_name' => 'required|max:255',
            'last_name' => 'nullable|max:255',
            'email' => $emailRule,
            'password' => 'required|min:6|max:255',
            'type' => 'required|in:employee,owner'
        ];
    }
}