<?php

namespace App\Interpreters\FormFieldAnswer;

use App\Filters\FormFieldAnswer\FormFieldAnswerFilter;
use App\Interpreters\DbInterpreter;
use Illuminate\Database\Eloquent\Builder;

class FormFieldAnswerFormIdInterpreter extends DbInterpreter
{
    private FormFieldAnswerFilter $filter;

    public function __construct(
        FormFieldAnswerFilter $filter
    )
    {
        $this->filter = $filter;
    }

    public function interpret(): Builder
    {
        $formId = $this->filter->getFormId();

        if (blank($formId)) return $this->query;

        return $this->query->where('form_id', $formId);
    }
}