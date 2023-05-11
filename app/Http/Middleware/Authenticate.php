<?php

namespace App\Http\Middleware;

use App\Contracts\CookieEnum;
use App\Datas\User\UserUpdateData;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    private UserUpdateData $user;

    public function handle($request, Closure $next, ...$guards)
    {
        if (blank($request->bearerToken()) && blank(getCookie(CookieEnum::ADM_TOKEN))) throw new AuthenticationException();

        $auth = $this->auth->guard(...$guards);

        if (!$auth->check()) throw new AuthorizationException('authorization_failed', Response::HTTP_UNAUTHORIZED);
        
        $this->user = $auth->user();

        $this->setGlobalConfigs();

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        //
    }

    private function setGlobalConfigs(): void
    {
        config(['organization_id' => $this->user->getOrganizationId()]);
        config(['user_id' => $this->user->getId()]);
        config(['user_type' => $this->user->getType()]);
    }
}
