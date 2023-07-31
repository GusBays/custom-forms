<?php

namespace App\Http\Controllers;

use App\Datas\FormAnswer\FormAnswerUpdateData;
use App\Filters\FormAnswer\FormAnswerFillerIdFilter;
use App\Filters\FormAnswer\FormAnswerFormIdFilter;
use App\Resources\FormAnswerResource;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class ReportController
{
    private ReportService $service;

    public function __construct(
        ReportService $service
    )
    {
        $this->service = $service;
    }

    public function getAnswersByFiller(Request $request): HttpResponse
    {
        $data = $this->service->getAnswersBy(new FormAnswerFillerIdFilter($request->route('filler_id')));

        $toResource = fn (FormAnswerUpdateData $answer) => new FormAnswerResource($answer);
        $data = collect($data)->map($toResource)->all();

        return response($data, Response::HTTP_OK);
    }

    public function getAnswersByForm(Request $request): HttpResponse
    {
        $data = $this->service->getAnswersBy(new FormAnswerFormIdFilter($request->route('form_id')));

        $toResource = fn (FormAnswerUpdateData $answer) => new FormAnswerResource($answer);
        $data = collect($data)->map($toResource)->all();

        return response($data, Response::HTTP_OK);
    }
}