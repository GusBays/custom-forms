<?php

namespace App\Services;

use App\Datas\Form\FormData;
use App\Datas\Form\FormUpdateData;
use App\Filters\Form\FormFilter;
use App\Repositories\FormRepository;
use Illuminate\Http\Request;

class FormService
{
    protected FormRepository $repository;

    public function __construct(
        FormRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function create(FormData $data): FormUpdateData
    {   
        return $this->repository->create($data);
    }

    /**
     * @var FormUpdateData[]
     */
    public function getPaginate(Request $request): ?array
    {
        return $this->repository->getPaginate($request);
    }

    public function getOne(FormFilter $filter): FormUpdateData
    {
        return $this->repository->getOne($filter);
    }

    public function update(FormUpdateData $data): FormUpdateData
    {
        return $this->repository->update($data);
    }

    public function delete(FormFilter $filter): void
    {
        $this->repository->delete($filter);
    }
}