<?php

namespace App\Http\Controllers;

use App\Filters\Form\FormIdFilter;
use App\Http\Adapters\Form\FormRequestAdapter;
use App\Http\Adapters\Form\FormUpdateRequestAdapter;
use App\Resources\FormResource;
use App\Services\FormService;
use App\Validators\FormValidator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class FormController
{
    protected FormService $service;

    public function __construct(
        FormService $service
    )
    {
        $this->service = $service;
    }

    public function store(Request $request): HttpResponse
    {
        $validator = new FormValidator($request);
        $validator->validate();

        $resource = new FormResource($this->service->create(new FormRequestAdapter($request)));

        return response($resource, Response::HTTP_CREATED);
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        return FormResource::collection($this->service->getPaginate($request));
    }

    public function show(Request $request): FormResource
    {
        return new FormResource($this->service->getOne(new FormIdFilter($request)));
    }

    public function update(Request $request): FormResource
    {
        $validator = new FormValidator($request);
        $validator->setId($request->route('id'))
            ->validate();

        return new FormResource($this->service->update(new FormUpdateRequestAdapter($request)));
    }

    public function destroy(Request $request): HttpResponse
    {
        $this->service->delete(new FormIdFilter($request));

        return response('', Response::HTTP_NO_CONTENT);
    }
}