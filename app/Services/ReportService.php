<?php

namespace App\Services;

use App\Filters\FormAnswer\FormAnswerFilter;
use App\Repositories\ReportRepository;

class ReportService
{
    private ReportRepository $repository;

    public function __construct(
        ReportRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function getAnswersBy(FormAnswerFilter $filter): array
    {
        return $this->repository->getAnswersBy($filter);
    }
}