<?php

namespace App\Http\Controllers;

use App\Datas\Form\FormUpdateData;
use App\Datas\Organization\OrganizationUpdateData;
use App\Datas\User\UserUpdateData;
use App\Resources\FormResource;
use App\Resources\UserResource;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ViewsController
{
    private OrganizationController $organizationController;
    private FormController $formController;
    private UserController $userController;

    public function __construct(
        OrganizationController $organizationController,
        FormController $formController,
        UserController $userController
    )
    {
        $this->organizationController = $organizationController;
        $this->formController = $formController;
        $this->userController = $userController;
    }

    public function home(): View
    {
        return view('home');
    }

    public function entrar(): View
    {
        return view('login');
    }

    public function cadastro(): View
    {
        return view('register');
    }

    public function recuperar(): View
    {
        return view('recover');
    }

    public function admin(Request $request): View
    {
        try {
            /** @var OrganizationUpdateData */
            $organization = $this->organizationController->show($request)->resource;
        } catch (\Throwable $th) {
            return view('error', ['error' => $th->getMessage()]);
        }

        $byUserId = fn (UserUpdateData $user) => config('user_id') === $user->getId();
        $user = collect($organization->getUsers())
            ->filter($byUserId)
            ->first();

        $toResource = fn (FormResource $formResource) => $formResource->resource;
        $byDate = fn (FormUpdateData $form) => $form->getCreatedAt();
        $forms = $this->formController->index($request)
            ->collection
            ->map($toResource)
            ->sort($byDate)
            ->slice(0, 6)
            ->all();

        $data = collect()
            ->merge(['organization' => $organization])
            ->merge(['user' => $user])
            ->merge(['forms' => $forms])
            ->all();

        return view('admin-home', $data);
    }

    public function forms(Request $request): View
    {
        try {
            $forms = $this->formController->index($request);
        } catch (ModelNotFoundException $th) {
            return view('error', ['error' => $th->getMessage()]);
        }

        $toResource = fn (FormResource $form) => $form->resource;
        $forms = $forms->collection
            ->map($toResource)
            ->all();

        return view('forms', ['forms' => $forms]);
    }

    public function form(Request $request): View
    {
        try {
            /** @var FormUpdateData */
            $form = $this->formController->show($request)->resource;
        } catch (ModelNotFoundException $th) {
            return view('error', ['error' => $th->getMessage()]);
        }

        return view('form', ['form' => $form]);
    }

    public function formFieldsAnswer(Request $request): View
    {
        try {
            /** @var FormUpdateData */
            $form = $this->formController->getOneBySlug($request)->resource;
        } catch (ModelNotFoundException $th) {
            return view('error', ['error' => $th->getMessage()]);
        }

        return view('formFieldsAnswer', ['form' => $form]);
    }

    public function users(Request $request): View
    {
        try {
            $users = $this->userController->index($request);
        } catch (\Throwable $th) {
            return view('error', ['error' => $th->getMessage()]);
        }

        $toResource = fn (UserResource $user) => $user->resource;
        $users = $users->collection
            ->map($toResource)
            ->all();

        return view('users', ['users' => $users]);
    }
}