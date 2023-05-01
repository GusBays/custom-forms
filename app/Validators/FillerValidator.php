<?php

namespace App\Validators;

class FillerValidator extends RequestValidator
{
    public function getRules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255|unique:fillers',
        ];
    }
}