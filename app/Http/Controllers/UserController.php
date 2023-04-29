<?php

namespace App\Http\Controllers;

use App\Filters\User\UserIdFilter;
use App\Http\Adapters\User\UserRequestAdapter;
use App\Http\Adapters\User\UserRequestUpdateAdapter;
use App\Resources\UserResource;
use App\Services\UserService;
use App\Validators\UserLoginValidator;
use App\Validators\UserValidator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController
{
    protected UserService $service;

    public function __construct(
        UserService $service
    )
    {
        $this->service = $service;
    }

    public function store(Request $request): HttpResponse
    {
        $validator = new UserValidator($request);
        $validator->validate();
        
        $resource = new UserResource($this->service->create(new UserRequestAdapter($request)));
        
        return response($resource, Response::HTTP_CREATED);
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        return UserResource::collection($this->service->getPaginate($request)); 
    }

    public function show(Request $request): UserResource
    {
        return new UserResource($this->service->getOne(new UserIdFilter($request)));
    }

    public function update(Request $request): UserResource
    {
        $validator = new UserValidator($request);
        $validator->setId($request->route('id'))
            ->validate();

        return new UserResource($this->service->update(new UserRequestUpdateAdapter($request)));
    }

    public function destroy(Request $request): HttpResponse
    {
        $this->service->delete(new UserIdFilter($request));

        return response('', Response::HTTP_NO_CONTENT);
    }

    public function login(Request $request): UserResource
    {
        $validator = new UserLoginValidator($request);
        $validator->validate();

        return new UserResource($this->service->login($request));
    }
}