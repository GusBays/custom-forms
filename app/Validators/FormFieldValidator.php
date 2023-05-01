<?php

namespace App\Validators;

class FormFieldValidator extends RequestValidator
{
    public function getRules(): array
    {
        return [
            'form_id' => 'required|integer|exists:forms,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:512',
            'required' => 'required|boolean',
            'type' => 'required|in:text,checkbox,select,table',
            'content' => 'array'
        ];
    }
}