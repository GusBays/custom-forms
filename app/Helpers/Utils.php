<?php

namespace App\Helpers;

use App\Contracts\CookieEnum;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Utils
{
    public static function getOrganizationIdFromAuth(): ?int
    {
        $token = request()->bearerToken() ?? getCookie(CookieEnum::ADM_TOKEN);

        if (blank($token)) return null;

        $decodedAuth = (new JWT)->decode(
            $token,
            new Key(env('APP_KEY'), 'HS256') 
        );

        return $decodedAuth->organization_id;
    }
}