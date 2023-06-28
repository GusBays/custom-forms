<?php

namespace App\Http\Controllers;

use App\Contracts\RedirectEnum;
use App\Datas\Filler\FillerUpdateData;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FillerActionController extends ActionController
{
    private FillerController $fillerController;

    public function __construct(
        OrganizationController $organizationController,
        UserController $userController,
        FillerController $fillerController
    )
    {
        $this->fillerController = $fillerController;
        parent::__construct(
            $organizationController,
            $userController
        );
    }

    public function create(Request $request): RedirectResponse
    {
        try {
            $filler = $this->fillerController->store($request);
        } catch (\Throwable $th) {
            dd('filler-create-action', $th);
        }

        /** @var FillerUpdateData */
        $data = $filler->getOriginalContent()->resource;

        return redirect(RedirectEnum::FILLERS . '/' . $data->getId());
    }
}