<?php

namespace App\Interpreters\User;

use App\Filters\User\UserFilter;
use App\Interpreters\DbInterpreter;
use Illuminate\Database\Eloquent\Builder;

class UserEmailInterpreter extends DbInterpreter
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
        $email = $this->filter->getEmail();

        if (blank($email)) return $this->query;

        return $this->query->where('email', $email);
    }
}