<?php

namespace App\Http\Controllers;

use App\Contracts\RedirectEnum;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;

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

    public function show(int $id)
    {
        return $this->service->getOne($id);
    }

    public function index()
    {
        return $this->service->getPaginate();
    }

    public function update(int $id, Request $request)
    {
        return $this->service->update($id, $request);
    }

    public function delete(int $id): HttpResponse
    {
        $this->service->delete($id);

        return response('', Response::HTTP_NO_CONTENT);
    }

    protected function isBladeRequest(): bool
    {
        $host = request()->header('referer');

        if (blank($host)) return false;

        return true;
    }
}