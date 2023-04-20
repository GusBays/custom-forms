<?php

namespace App\Http\Controllers;

use App\Services\BaseService;
use Illuminate\Http\Request;

class BaseController
{
    /** @var BaseService */
    protected $service;

    public function __construct(
        BaseService $service
    )
    {
        $this->service = $service; 
    }

    public function create(Request $request): array
    {
        return $this->service->create($request);
    }
}