<?php

namespace App\Interpreters\FormFieldAnswer;

use App\Filters\FormFieldAnswer\FormFieldAnswerFilter;
use App\Interpreters\DbInterpreter;
use Illuminate\Database\Eloquent\Builder;

class FormFieldAnswerFieldIdInterpreter extends DbInterpreter
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
        $fieldId = $this->filter->getFieldId();

        if (blank($fieldId)) return $this->query;

        return $this->query->where('field_id', $fieldId);
    }
}