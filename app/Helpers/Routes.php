<?php

namespace App\Helpers;

use App\Contracts\RedirectEnum;

class Routes
{
    public static function isAuthWebMiddleware(): bool
    {
        return request()->is('admin');
    }

    public static function isAuthApiMiddleware(): bool
    {
        return request()->is('api/*');
    }
}