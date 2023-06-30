<?php

namespace App\Filters\FormAnswer;

class FormAnswerFormIdFilter extends FormAnswerFilter
{
    public function __construct(
        int $formId
    )
    {
        parent::__construct(
            null,
            $formId,
            null
        );
    }
}