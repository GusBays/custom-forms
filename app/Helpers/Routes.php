<?php

namespace App\Helpers;

use App\Contracts\RedirectEnum;

class Routes
{
    public static function isAuthWebMiddleware(string $route): bool
    {
        $routes = [
            RedirectEnum::ADMIN
        ];

        return (in_array($route, $routes));
    }

    public static function isAuthApiMiddleware(string $route): bool
    {
        $routes = [
            
        ];

        return (in_array($route, $routes));
    }
}