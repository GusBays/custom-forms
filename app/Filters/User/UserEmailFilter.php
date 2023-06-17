<?php

namespace App\Filters\User;

use Illuminate\Http\Request;

class UserEmailFilter extends UserFilter
{
    public function __construct(
        string $email
    )
    {
        parent::__construct(
            null,
            $email,
            null
        );
    }
}