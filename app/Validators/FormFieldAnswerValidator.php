<?php

namespace App\Validators;

class FormFieldAnswerValidator extends RequestValidator
{
    public function getRules(): array
    {
        return [
            'form_id' => 'required|integer|exists:forms,id',
            'field_id' => 'required|integer|exists:form_fields,id',
            'filler_id' => 'nullable|integer|exists:fillers,id',
            'answer' => 'nullable|array',
        ];
    }
}