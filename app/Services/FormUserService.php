<?php

namespace App\Services;

use App\Datas\FormUser\FormUserData;
use App\Datas\FormUser\FormUserUpdateData;
use App\Filters\FormUser\FormUserFilter;
use App\Repositories\FormUserRepository;
use Illuminate\Http\Request;

class FormUserService
{
    protected FormUserRepository $repository;

    public function __construct(
        FormUserRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function create(FormUserData $data): FormUserUpdateData
    {
        return $this->repository->create($data);
    }

    /**
     * @return FormUserUpdateData[]
     */
    public function getPaginate(Request $request): array
    {
        return $this->repository->getPaginate($request);
    }

    public function update(FormUserUpdateData $data): FormUserUpdateData
    {
        return $this->repository->update($data);
    }

    public function delete(FormUserFilter $filter): void
    {
        $this->repository->delete($filter);
    }
}