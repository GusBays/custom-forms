<?php

namespace App\Filters\User;

class UserIdFilter extends UserFilter
{
    public function __construct(
        int $id
    )
    {
        parent::__construct($id);
    }
}