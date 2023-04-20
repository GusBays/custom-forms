<?php

namespace App\Http\Controllers;

use App\Contracts\CookieEnum;
use App\Contracts\RedirectEnum;
use App\Http\Controllers\BaseController;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /** @var UserService */
    protected $service;
    protected string $to = RedirectEnum::ADMIN;

    public function __construct(
        UserService $service
    )
    {
        $this->service = $service;
    }

    public function create(Request $request)
    {
        $resource = parent::create($request);

        if ($this->isBladeRequest()) return redirect($this->to);

        return $resource;
    }

    public function login(Request $request)
    {
        $resource = $this->service->login($request);

        if ($this->isBladeRequest()) return redirect($this->to);

        return $resource;
    }
}