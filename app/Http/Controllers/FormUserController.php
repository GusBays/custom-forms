<?php

namespace App\Http\Controllers;

use App\Filters\FormUser\FormUserIdFilter;
use App\Http\Adapters\FormUser\FormUserRequestAdapter;
use App\Http\Adapters\FormUser\FormUserUpdateRequestAdapter;
use App\Resources\FormUserResource;
use App\Services\FormUserService;
use App\Validators\FormUserValidator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class FormUserController
{
    protected FormUserService $service;

    public function __construct(
        FormUserService $service
    )
    {
        $this->service = $service;
    }

    public function store(Request $request): HttpResponse
    {
        $validator = new FormUserValidator($request);
        $validator->validate();

        $resource = new FormUserResource($this->service->create(new FormUserRequestAdapter($request)));

        return response($resource, Response::HTTP_CREATED);
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        return FormUserResource::collection($this->service->getPaginate($request));
    }

    public function update(Request $request): FormUserResource
    {
        $validator = new FormUserValidator($request);
        $validator->setId($request->route('id'))
            ->validate();

        return new FormUserResource($this->service->update(new FormUserUpdateRequestAdapter($request)));
    }

    public function destroy(Request $request): HttpResponse
    {
        $this->service->delete(new FormUserIdFilter($request));

        return response('', Response::HTTP_NO_CONTENT);
    }
}