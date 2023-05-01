<?php

namespace App\Validators;

class FormUserValidator extends RequestValidator
{
    public function getRules(): array
    {
        return [
            'form_id' => 'required|integer|exists:forms,id',
            'user_id' => 'required|integer|exists:users,id',
            'type' => 'required|in:creator,editor,viewer',
        ];
    }
}