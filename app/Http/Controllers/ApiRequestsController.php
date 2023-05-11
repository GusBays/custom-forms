<?php

namespace App\Http\Controllers;

use App\Contracts\CookieEnum;
use App\Contracts\RedirectEnum;
use Illuminate\Http\Request;

class ApiRequestsController
{
    private ViewsController $viewsController;
    private OrganizationController $organizationController;
    private UserController $userController;

    public function __construct(
        ViewsController $viewsController,
        OrganizationController $organizationController,
        UserController $userController
    )
    {
        $this->viewsController = $viewsController;
        $this->organizationController = $organizationController;
        $this->userController = $userController;
    }

    public function createOrganization(Request $request)
    {
        try {
            $this->organizationController->store($request);
        } catch (\Throwable $th) {
            return $this->viewsController->error($th);
        }

        $firstUser = $this->userController->index($request)->first();

        addCookie(CookieEnum::ADM_TOKEN, $firstUser->getToken());

        return redirect(RedirectEnum::ADMIN);
    }

    public function login(Request $request)
    {
        try {
            $user = $this->userController->login($request);
        } catch (\Throwable $th) {
            return $this->viewsController->error($th);
        }

        addCookie(CookieEnum::ADM_TOKEN, $user->resource->getToken());

        return redirect(RedirectEnum::ADMIN);
    }

    public function admin(Request $request)
    { 
        try {
            $organization = $this->organizationController->show($request);
        } catch (\Throwable $th) {
            return $this->viewsController->error($th);
        }

        return $this->viewsController->admin($organization->toArray($request));
    }
}