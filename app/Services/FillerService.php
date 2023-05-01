<?php

namespace App\Services;

use App\Datas\Filler\FillerData;
use App\Datas\Filler\FillerUpdateData;
use App\Filters\Filler\FillerFilter;
use App\Repositories\FillerRepository;
use Illuminate\Http\Request;

class FillerService
{
    protected FillerRepository $repository;

    public function __construct(
        FillerRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function create(FillerData $data): FillerUpdateData
    {
        return $this->repository->create($data);
    }

    /**
     * @return FillerUpdateData[]
     */
    public function getPaginate(Request $request): array
    {
        return $this->repository->getPaginate($request);
    }

    public function getOne(FillerFilter $filter): FillerUpdateData
    {
        return $this->repository->getOne($filter);
    }

    public function update(FillerUpdateData $data): FillerUpdateData
    {
        return $this->repository->update($data);
    }

    public function delete(FillerFilter $filter): void
    {
        $this->repository->delete($filter);
    }
}