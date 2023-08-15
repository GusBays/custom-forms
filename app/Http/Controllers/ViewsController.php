<?php

namespace App\Http\Controllers;

use App\Datas\Form\FormUpdateData;
use App\Datas\Organization\OrganizationUpdateData;
use App\Datas\User\UserUpdateData;
use App\Resources\FillerResource;
use App\Resources\FormResource;
use App\Resources\UserResource;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ViewsController
{
    private OrganizationController $organizationController;
    private FormController $formController;
    private FillerController $fillerController;
    private UserController $userController;

    public function __construct(
        OrganizationController $organizationController,
        FormController $formController,
        FillerController $fillerController,
        UserController $userController
    )
    {
        $this->organizationController = $organizationController;
        $this->formController = $formController;
        $this->fillerController = $fillerController;
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

    public function responder(Request $request): View
    {
        try {
            $form = $this->formController->getOneBySlug($request);
        } catch (\Throwable $e) {
            dd('answer', $e);
        }

        return view('answer', ['form' => $form->resource]);
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

        $data = collect()
            ->merge(['organization' => $organization])
            ->merge(['user' => $user])
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

        return view('sidebar/forms/forms-list', ['forms' => $forms]);
    }

    public function form(Request $request): View
    {
        try {
            /** @var FormUpdateData */
            $form = $this->formController->show($request)->resource;
        } catch (ModelNotFoundException $th) {
            return view('error', ['error' => $th->getMessage()]);
        }

        return view('sidebar/forms/form-detail', ['form' => $form]);
    }

    public function newForm(Request $request): View
    {
        try {
            $user = $this->userController->show(new Request(['id' => config('user_id')]));
        } catch (ModelNotFoundException $e) {
            dd($e);
        }

        return view('sidebar/forms/form-new', ['user' => $user->resource]);
    }

    public function fillers(Request $request): View
    {
        try {
            $fillers = $this->fillerController->index($request);
        } catch (\Throwable $th) {
            dd('fillers', $th);
        }

        $toResource = fn (FillerResource $filler) => $filler->resource;
        $fillers = $fillers->collection
            ->map($toResource)
            ->all();

        return view('sidebar.fillers.fillers-list', ['fillers' => $fillers]);
    }

    public function filler(Request $request): View
    {
        try {
            $filler = $this->fillerController->show($request);
        } catch (ModelNotFoundException $e) {
            dd($e, 'filler');
        }

        return view('sidebar/fillers/filler-detail', ['filler' => $filler->resource]);
    }

    public function newFiller(Request $request): View
    {
        return view('sidebar/fillers/filler-new');
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

        return view('sidebar.users.users-list', ['users' => $users]);
    }

    public function user(Request $request): View
    {
        try {
            $user = $this->userController->show($request);
        } catch (ModelNotFoundException $th) {
            return view('error', ['error' => $th->getMessage()]);
        }

        return view('sidebar.users.user-detail', ['user' => $user->resource]);
    }

    public function newUser(Request $request): View
    {
        return view('sidebar/users/user-new');
    }
}