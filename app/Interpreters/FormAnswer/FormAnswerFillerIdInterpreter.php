<?php

namespace App\Interpreters\FormAnswer;

use App\Filters\FormAnswer\FormAnswerFilter;
use App\Interpreters\DbInterpreter;
use Illuminate\Database\Eloquent\Builder;

class FormAnswerFillerIdInterpreter extends DbInterpreter
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
        $fillerId = $this->filter->getFillerId();

        if (blank($fillerId)) return $this->query;

        return $this->query->where('filler_id', $fillerId);
    }
}