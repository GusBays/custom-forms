<?php

namespace App\Validators;

class FormAnswerValidator extends RequestValidator
{
    public function getRules(): array
    {
        return [
            'email' => 'required|string',
            'form_id' => 'required|integer|exists:forms,id',
            'filler_id' => 'nullable|integer|exists:fillers,id',
            'answers' => 'required|array',
            'answers.*' => 'array',
            'answers.*.field_id' => 'required|integer|exists:form_fields,id',
            'answers.*.content' => 'required|array'
        ];
    }
}