<?php

namespace App\Http\Controllers;

use App\Http\Adapters\FormAnswer\FormAnswerRequestAdapter;
use App\Resources\FormAnswerResource;
use App\Services\FormAnswerService;
use App\Validators\FormAnswerValidator;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class FormAnswerController
{
    private FormAnswerService $service;

    public function __construct(
        FormAnswerService $service
    )
    {
        $this->service = $service;
    }

    public function store(Request $request): HttpResponse
    {
        $validator = new FormAnswerValidator($request);
        $validator->validate();

        $resource = new FormAnswerResource($this->service->create(new FormAnswerRequestAdapter($request), $request->email));

        return response($resource, Response::HTTP_CREATED);
    }
}