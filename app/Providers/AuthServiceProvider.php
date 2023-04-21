<?php

namespace App\Providers;

use App\Contracts\CookieEnum;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::viaRequest('jwt-token', function (Request $request) {
            try {
                return app(UserRepository::class)->getByToken($request->bearerToken());
            } catch (\Throwable $th) {
                return null;
            }
        });

        Auth::viaRequest('cookie-token', function () {
            try {
                return app(UserRepository::class)->getByToken(getCookie(CookieEnum::ADM_TOKEN));
            } catch (\Throwable $th) {
                return null;
            }
        });
    }
}
