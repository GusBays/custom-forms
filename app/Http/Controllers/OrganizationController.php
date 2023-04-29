<?php

namespace App\Http\Controllers;

use App\Http\Adapters\Organization\OrganizationRequestAdapter;
use App\Resources\OrganizationResource;
use App\Services\OrganizationService;
use App\Validators\OrganizationValidator;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class OrganizationController
{
    protected OrganizationService $service;

    public function __construct(
        OrganizationService $service
    )
    {
        $this->service = $service;
    }

    public function store(Request $request): HttpResponse
    {
        $validator = new OrganizationValidator($request);
        $validator->validate();

        $resource = new OrganizationResource($this->service->create(new OrganizationRequestAdapter($request)));

        return response($resource, Response::HTTP_CREATED);
    }
}