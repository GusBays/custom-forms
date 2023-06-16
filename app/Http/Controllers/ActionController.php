<?php

namespace App\Http\Controllers;

use App\Contracts\CookieEnum;
use App\Contracts\RedirectEnum;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ActionController
{
    private OrganizationController $organizationController;
    private UserController $userController;

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

        addCookie(CookieEnum::ADM_TOKEN, $user->getToken());

        return redirect(RedirectEnum::ADMIN);
    }
}