<?php

namespace App\Http\Controllers;

use App\Filters\Filler\FillerIdRequestFilter;
use App\Helpers\Paginator;
use App\Http\Adapters\Filler\FillerRequestAdapter;
use App\Http\Adapters\Filler\FillerUpdateRequestAdapter;
use App\Resources\FillerResource;
use App\Services\FillerService;
use App\Validators\FillerValidator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class FillerController
{
    protected FillerService $service;

    public function __construct(
        FillerService $service
    )
    {
        $this->service = $service;
    }

    public function store(Request $request): HttpResponse
    {
        $validator = new FillerValidator($request);
        $validator->validate();

        $resource = new FillerResource($this->service->create(new FillerRequestAdapter($request)));

        return response($resource, Response::HTTP_CREATED);
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        return FillerResource::collection(
            resource: Paginator::paginate($this->service->getPaginate($request))
        );
    }

    public function show(Request $request): FillerResource
    {
        return new FillerResource($this->service->getOne(new FillerIdRequestFilter($request)));
    }

    public function update(Request $request): FillerResource
    {
        $validator = new FillerValidator($request);
        $validator->setId($request->route('id'))
            ->validate();

        return new FillerResource($this->service->update(new FillerUpdateRequestAdapter($request)));
    }

    public function destroy(Request $request): HttpResponse
    {
        $this->service->delete(new FillerIdRequestFilter($request));

        return response('', Response::HTTP_NO_CONTENT);
    }
}