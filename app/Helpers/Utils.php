<?php

namespace App\Helpers;

use App\Contracts\CookieEnum;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Cookie;

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

    public static function addCookieAndReturnInstance(string $name, string $value, int $daysToExpire = 0): Cookie
    {
        if ($daysToExpire > 0) $expiresAt = Carbon::now()->addDays($daysToExpire)->getTimestamp();
        else $expiresAt = 0;

        return Cookie::create($name, $value, $expiresAt);
    }
}