<?php

namespace App\Interpreters\Form;

use App\Filters\Form\FormFilter;
use App\Interpreters\DbInterpreter;
use Illuminate\Database\Eloquent\Builder;

class FormIdInterpreter extends DbInterpreter
{
    private FormFilter $filter;

    public function __construct(
        FormFilter $filter
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