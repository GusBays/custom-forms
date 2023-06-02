<?php

namespace App\Filters\FormFieldAnswer;

class FormFieldAnswerFormIdFillerIdFilter extends FormFieldAnswerFilter
{
    public function __construct(
        int $formId,
        int $fillerId
    )
    {
        parent::__construct(
            null,
            $formId,
            $fillerId
        );
    }
}