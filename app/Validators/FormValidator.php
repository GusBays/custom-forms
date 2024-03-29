<?php

namespace App\Validators;

class FormValidator extends RequestValidator
{
    public function getRules(): array
    {
        return [
            'name' => 'required|max:255',
            'available_until' => 'nullable|date|date_format:Y-m-d H:i:s|after_or_equal:today',
            'fill_limt' => 'nullable|integer',
            'should_notify_each_fill' => 'nullable|boolean',
            'active' => 'nullable|boolean',
        ];
    }
}