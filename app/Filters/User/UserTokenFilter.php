<?php

namespace App\Filters\User;

use App\Contracts\CookieEnum;
use Illuminate\Http\Request;

class UserTokenFilter extends UserFilter
{
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            null,
            null,
            $request->bearerToken() ?? getCookie(CookieEnum::ADM_TOKEN)
        );
    }
}