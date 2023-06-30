<?php

namespace App\Interpreters\FormAnswer;

use App\Filters\FormAnswer\FormAnswerFilter;
use App\Interpreters\DbInterpreter;
use Illuminate\Database\Eloquent\Builder;

class FormAnswerFormIdInterpreter extends DbInterpreter
{
    private FormAnswerFilter $filter;

    public function __construct(
        FormAnswerFilter $filter
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