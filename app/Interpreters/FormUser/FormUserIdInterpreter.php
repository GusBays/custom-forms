<?php

namespace App\Interpreters\FormUser;

use App\Filters\FormUser\FormUserFilter;
use App\Interpreters\DbInterpreter;
use Illuminate\Database\Eloquent\Builder;

class FormUserIdInterpreter extends DbInterpreter
{
    private FormUserFilter $filter;

    public function __construct(
        FormUserFilter $filter
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