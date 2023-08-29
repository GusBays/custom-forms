<?php

namespace App\Validators;

class FillerValidator extends RequestValidator
{
    public function getRules(): array
    {
        if ($this->isUpdate) $emailRule = 'required|string|max:255';
        else $emailRule = 'required|string|max:255|unique:fillers';

        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => $emailRule,
        ];
    }
}