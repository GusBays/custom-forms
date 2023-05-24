<?php

namespace App\Http\Controllers;

use App\Contracts\CookieEnum;
use App\Contracts\RedirectEnum;
use App\Datas\Form\FormUpdateData;
use App\Datas\Organization\OrganizationUpdateData;
use App\Datas\User\UserUpdateData;
use App\Resources\FormResource;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ApiRequestsController
{
    private ViewsController $viewsController;
    private OrganizationController $organizationController;
    private UserController $userController;
    private FormController $formController;

    public function __construct(
        ViewsController $viewsController,
        OrganizationController $organizationController,
        UserController $userController,
        FormController $formController
    )
    {
        $this->viewsController = $viewsController;
        $this->organizationController = $organizationController;
        $this->userController = $userController;
        $this->formController = $formController;
    }

    public function createOrganization(Request $request): RedirectResponse
    {
        try {
            $this->organizationController->store($request);
        } catch (\Throwable $th) {
            return $this->viewsController->error($th);
        }

        /** @var UserUpdateData */
        $firstUser = $this->userController->index($request)->first();

        addCookie(CookieEnum::ADM_TOKEN, $firstUser->getToken());

        return redirect(RedirectEnum::ADMIN);
    }

    public function login(Request $request): RedirectResponse
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
            /** @var OrganizationUpdateData */
            $organization = $this->organizationController->show($request)->resource;
        } catch (\Throwable $th) {
            return $this->viewsController->error($th);
        }

        $byUserId = fn (UserUpdateData $user) => config('user_id') === $user->getId();
        $user = collect($organization->getUsers())
            ->filter($byUserId)
            ->first();

        $toResource = fn (FormResource $formResource) => $formResource->resource;
        $forms = $this->formController->index($request)
            ->collection
            ->map($toResource)
            ->all();

        $data = collect()
            ->merge(['organization' => $organization])
            ->merge(['user' => $user])
            ->merge(['forms' => $forms])
            ->all();

        return $this->viewsController->admin($data);
    }

    public function forms(Request $request): View
    {
        return view($this->viewsController->forms());
    }
}