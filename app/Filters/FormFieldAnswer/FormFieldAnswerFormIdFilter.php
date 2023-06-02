<?php

namespace App\Filters\FormFieldAnswer;

class FormFieldAnswerFormIdFilter extends FormFieldAnswerFilter
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