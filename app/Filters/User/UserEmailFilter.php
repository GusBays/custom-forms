<?php

namespace App\Filters\User;

use Illuminate\Http\Request;

class UserEmailFilter extends UserFilter
{
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            null,
            $request->input('email'),
            null
        );
    }
}