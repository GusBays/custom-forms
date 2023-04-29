<?php

namespace App\Http\Controllers;

use App\Services\FormUserService;

class FormUserController extends BaseController
{
    protected $service;

    public function __construct(
        FormUserService $service
    )
    {
        $this->service = $service;
    }
}