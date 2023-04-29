<?php

namespace App\Interpreters\User;

use App\Filters\User\UserFilter;
use App\Interpreters\DbInterpreter;
use Illuminate\Database\Eloquent\Builder;

class UserIdInterpreter extends DbInterpreter
{
    private UserFilter $filter;

    public function __construct(
        UserFilter $filter
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