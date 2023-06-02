<?php

namespace App\Interpreters\FormFieldAnswer;

use App\Filters\FormFieldAnswer\FormFieldAnswerFilter;
use App\Interpreters\DbInterpreter;
use Illuminate\Database\Eloquent\Builder;

class FormFieldAnswerFillerIdInterpreter extends DbInterpreter
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
        $fillerId = $this->filter->getFillerId();

        if (blank($fillerId)) return $this->query;

        return $this->query->where('filler_id', $fillerId);
    }
}