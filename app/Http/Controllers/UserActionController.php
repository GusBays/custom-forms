<?php

namespace App\Http\Controllers;

use App\Contracts\RedirectEnum;
use App\Datas\User\UserUpdateData;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class UserActionController extends ActionController
{
    public function create(Request $request): RedirectResponse
    {
        try {
            $user = $this->userController->store($request);
        } catch (\Throwable $th) {
            dump($th->getMessage());
        }

        /** @var UserUpdateData */
        $data = $user->getOriginalContent()->resource;

        return redirect(RedirectEnum::USERS . '/' . $data->getId());
    }

    public function update(Request $request): RedirectResponse
    {
        try {
            $user = $this->userController->update($request);
        } catch (\Throwable $th) {
            dump($th->getMessage());
        }

        /** @var UserUpdateData */
        $data = $user->resource;

        return redirect(RedirectEnum::USERS . '/' . $data->getId());
    }
}