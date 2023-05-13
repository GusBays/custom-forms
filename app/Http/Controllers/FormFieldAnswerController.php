<?php

namespace App\Http\Controllers;

use App\Http\Adapters\FormFieldAnswer\FormFieldAnswerRequestAdapter;
use App\Resources\FormFieldAnswerResource;
use App\Services\FormFieldAnswerService;
use App\Validators\FormFieldAnswerValidator;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class FormFieldAnswerController
{
    private FormFieldAnswerService $service;

    public function __construct(
        FormFieldAnswerService $service
    )
    {
        $this->service = $service;
    }

    public function store(Request $request): HttpResponse
    {
        if ($request->has('answers')) return $this->storeAll($request);

        $validator = new FormFieldAnswerValidator($request);
        $validator->validate();

        $resource = new FormFieldAnswerResource($this->service->create(new FormFieldAnswerRequestAdapter($request)));

        return response($resource, Response::HTTP_CREATED);
    }

    private function storeAll(Request $request): HttpResponse
    {
        $toRequest = fn (array $answer) => new Request($answer);
        $validate = fn (Request $answer) => (new FormFieldAnswerValidator($answer))->validate();
        collect($request->answers)->map($toRequest)->each($validate);

        $resources = $this->service->createFromArray(FormFieldAnswerRequestAdapter::createFromRequestArray($request->answers));

        return response(
            collect($resources)
            ->mapInto(FormFieldAnswerResource::class)
            ->all(),
            Response::HTTP_CREATED
        );
    }
}