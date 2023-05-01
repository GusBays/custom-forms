<?php

namespace App\Services;

use App\Datas\FormField\FormFieldData;
use App\Datas\FormField\FormFieldUpdateData;
use App\Filters\FormField\FormFieldFilter;
use App\Repositories\FormFieldRepository;
use Illuminate\Http\Request;

class FormFieldService
{
    protected FormFieldRepository $repository;

    public function __construct(
        FormFieldRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function create(FormFieldData $data): FormFieldUpdateData
    {
        return $this->repository->create($data);
    }

    /**
     * @var FormFieldUpdateData[]
     */
    public function getPaginate(Request $request): array
    {
        return $this->repository->getPaginate($request);
    }

    public function getOne(FormFieldFilter $filter): FormFieldUpdateData
    {
        return $this->repository->getOne($filter);
    }

    public function update(FormFieldUpdateData $data): FormFieldUpdateData
    {
        return $this->repository->update($data);
    }

    public function delete(FormFieldFilter $filter): void
    {
        $this->repository->delete($filter);
    }
}