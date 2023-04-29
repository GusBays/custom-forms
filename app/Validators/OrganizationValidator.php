<?php

namespace App\Validators;

class OrganizationValidator extends RequestValidator
{
    public function getRules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'first_name' => 'required|max:255',
            'last_name' => 'nullable|max:255',
            'password' => 'required|min:6|max:255',
        ];
    }
}