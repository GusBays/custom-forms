<?php

namespace App\Providers;

use App\Filters\User\UserTokenFilter;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                return app(UserRepository::class)->getByToken(new UserTokenFilter($request));
            } catch (\Throwable $th) {
                return null;
            }
        });

        Auth::viaRequest('cookie-token', function (Request $request) {
            try {
                return app(UserRepository::class)->getByToken(new UserTokenFilter($request));
            } catch (\Throwable $th) {
                return null;
            }
        });
    }
}
