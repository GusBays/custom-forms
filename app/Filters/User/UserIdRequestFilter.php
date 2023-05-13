<?php

namespace App\Filters\User;

use Illuminate\Http\Request;

class UserIdRequestFilter extends UserFilter
{
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            $request->route('id'),
            null,
            null
        );
    }
}