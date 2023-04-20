<?php

namespace App\Http\Controllers;

use App\Contracts\RedirectEnum;
use App\Services\BaseService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BaseController
{
    /** @var BaseService */
    protected $service;
    protected string $to = RedirectEnum::HOME;

    public function __construct(
        BaseService $service
    )
    {
        $this->service = $service; 
    }

    public function create(Request $request)
    {
        return $this->service->create($request);
    }

    protected function isBladeRequest(): bool
    {
        $host = request()->header('referer');

        if (blank($host)) return false;

        return true;
    }
}