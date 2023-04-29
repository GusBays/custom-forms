<?php

namespace App\Filters\User;

use Illuminate\Http\Request;

class UserIdFilter extends UserFilter
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