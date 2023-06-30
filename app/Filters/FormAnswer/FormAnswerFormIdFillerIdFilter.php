<?php

namespace App\Filters\FormAnswer;

class FormAnswerFormIdFillerIdFilter extends FormAnswerFilter
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