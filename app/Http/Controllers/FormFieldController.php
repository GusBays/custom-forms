<?php

namespace App\Http\Controllers;

use App\Filters\FormField\FormFieldIdRequestFilter;
use App\Helpers\Paginator;
use App\Http\Adapters\FormField\FormFieldRequestAdapter;
use App\Http\Adapters\FormField\FormFieldUpdateRequestAdapter;
use App\Resources\FormFieldResource;
use App\Services\FormFieldService;
use App\Validators\FormFieldValidator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class FormFieldController
{
    protected FormFieldService $service;

    public function __construct(
        FormFieldService $service
    )
    {
        $this->service = $service;
    }

    public function store(Request $request): HttpResponse
    {
        $validator = new FormFieldValidator($request);
        $validator->validate();

        $resource = new FormFieldResource($this->service->create(new FormFieldRequestAdapter($request)));

        return response($resource, Response::HTTP_CREATED);
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        return FormFieldResource::collection(
            resource: Paginator::paginate($this->service->getPaginate($request))
        );
    }

    public function show(Request $request): FormFieldResource
    {
        return new FormFieldResource($this->service->getOne(new FormFieldIdRequestFilter($request)));
    }

    public function update(Request $request): FormFieldResource
    {
        $validator = new FormFieldValidator($request);
        $validator->setId($request->route('id'))
            ->validate();

        return new FormFieldResource($this->service->update(new FormFieldUpdateRequestAdapter($request)));
    }

    public function destroy(Request $request): HttpResponse
    {
        $this->service->delete(new FormFieldIdRequestFilter($request));

        return response('', Response::HTTP_NO_CONTENT);
    }
}