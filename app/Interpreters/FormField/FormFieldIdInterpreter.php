<?php

namespace App\Interpreters\FormField;

use App\Filters\FormField\FormFieldFilter;
use App\Interpreters\DbInterpreter;
use Illuminate\Database\Eloquent\Builder;

class FormFieldIdInterpreter extends DbInterpreter
{
    private FormFieldFilter $filter;

    public function __construct(
        FormFieldFilter $filter
    )
    {
        $this->filter = $filter;
    }

    public function interpret(): Builder
    {
        $id = $this->filter->getId();

        if (blank($id)) return $this->query;

        return $this->query->where('id', $id);
    }
}