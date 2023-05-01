<?php

namespace App\Services;

use App\Datas\Form\FormData;
use App\Datas\Form\FormUpdateData;
use App\Filters\Form\FormFilter;
use App\Helpers\Validator;
use App\Http\Adapters\Form\FormModelAdapter;
use App\Repositories\FormRepository;
use App\Repositories\FormUserRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FormService
{
    protected FormRepository $repository;
    protected FormUserRepository $formUserRepository;

    public function __construct(
        FormRepository $repository,
        FormUserRepository $formUserRepository
    )
    {
        $this->repository = $repository;
        $this->formUserRepository = $formUserRepository;
    }

    public function create(FormData $data): FormUpdateData
    {   
        $form = $this->repository->create($data);

        $this->formUserRepository->createFirstFormUser($form);
        
        return $form;
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