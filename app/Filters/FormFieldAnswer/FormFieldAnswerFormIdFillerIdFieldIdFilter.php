<?php

namespace App\Filters\FormFieldAnswer;

class FormFieldAnswerFormIdFillerIdFieldIdFilter extends FormFieldAnswerFilter
{
    public function __construct(
        int $formId,
        int $fillerId,
        int $fieldId
    )
    {
        parent::__construct(
            null,
            $formId,
            $fillerId,
            $fieldId
        );
    }
}