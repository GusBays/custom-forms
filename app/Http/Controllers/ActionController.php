<?php

namespace App\Http\Controllers;

use App\Contracts\CookieEnum;
use App\Contracts\RedirectEnum;
use App\Datas\User\UserUpdateData;
use App\Helpers\Utils;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ActionController
{
    private OrganizationController $organizationController;
    protected UserController $userController;

    public function __construct(
        OrganizationController $organizationController,
        UserController $userController,
    )
    {
        $this->organizationController = $organizationController;
        $this->userController = $userController;
    }

    public function createOrganization(Request $request): RedirectResponse
    {
        try {
            $this->organizationController->store($request);
        } catch (\Throwable $th) {
            return view('error', ['error' => $th->getMessage()]);
        }

        /** @var UserUpdateData */
        $firstUser = $this->userController->index($request)->first();

        addCookie(CookieEnum::ADM_TOKEN, $firstUser->getToken());

        return redirect(RedirectEnum::ADMIN);
    }

    public function login(Request $request): RedirectResponse
    {
        try {
            /** @var UserUpdateData */
            $user = $this->userController->login($request)->resource;
        } catch (\Throwable $th) {
            return view('error', ['error' => $th->getMessage()]);
        }

        if ($request->has('keep_connected')) $daysToExpire = 7;
        else $daysToExpire = 0;

        $cookie = Utils::addCookieAndReturnInstance(CookieEnum::ADM_TOKEN, $user->getToken(), $daysToExpire);

        return redirect(RedirectEnum::ADMIN)->withCookie($cookie);
    }

    public function recoverPassword(Request $request): RedirectResponse
    {
        try {
            $this->userController->recoverPassword($request);
        } catch (\Throwable $th) {
            return view('error', ['error' => $th->getMessage()]);
        }

        return redirect(RedirectEnum::ENTRAR);
    }

    public function logoff(Request $request): RedirectResponse
    {
        return redirect(RedirectEnum::ENTRAR)->withoutCookie(CookieEnum::ADM_TOKEN);
    }
}