<?php

namespace App\Services;

use App\Datas\Form\FormData;
use App\Datas\Form\FormUpdateData;
use App\Filters\Form\FormFilter;
use App\Filters\Form\FormIdFilter;
use App\Http\Adapters\FormUser\FormUserCreatorAdapter;
use App\Repositories\FormFieldRepository;
use App\Repositories\FormRepository;
use App\Repositories\FormUserRepository;
use Illuminate\Http\Request;

class FormService
{
    protected FormRepository $repository;
    protected FormUserRepository $formUserRepository;
    protected FormFieldRepository $formFieldRepository;

    public function __construct(
        FormRepository $repository,
        FormUserRepository $formUserRepository,
        FormFieldRepository $formFieldRepository
    )
    {
        $this->repository = $repository;
        $this->formUserRepository = $formUserRepository;
        $this->formFieldRepository = $formFieldRepository;
    }

    public function create(FormData $data): FormUpdateData
    {
        $form = $this->repository->create($data);

        $this->formUserRepository->create(new FormUserCreatorAdapter($form->getId()));

        $this->formFieldRepository->createFromArray($form->getId(), $data->getFormFields());

        return $this->repository->getOne(new FormIdFilter($form->getId()));
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