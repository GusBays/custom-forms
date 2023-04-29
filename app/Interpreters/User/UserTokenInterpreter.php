<?php

namespace App\Interpreters\User;

use App\Filters\User\UserFilter;
use App\Interpreters\DbInterpreter;
use Illuminate\Database\Eloquent\Builder;

class UserTokenInterpreter extends DbInterpreter
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
        $token = $this->filter->getToken();

        if (blank($token)) return $this->query;

        return $this->query->where('token', $token);
    }
}