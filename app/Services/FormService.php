<?php

namespace App\Services;

use App\Datas\Form\FormData;
use App\Datas\Form\FormUpdateData;
use App\Datas\FormField\FormFieldData;
use App\Datas\FormField\FormFieldUpdateData;
use App\Datas\FormUser\FormUserData;
use App\Datas\FormUser\FormUserUpdateData;
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

        $firstUser = $this->formUserRepository->create(new FormUserCreatorAdapter($form->getId()));

        $creator = fn (FormUserData $formUser) => $firstUser->getUserId() === $formUser->getUserId();
        $toSetFormId = fn (FormUserData $formUser) => $formUser->setFormId($form->getId());
        $create = fn (FormUserData $formUser) => $this->formUserRepository->create($formUser);
        collect($data->getFormUsers())
            ->reject($creator)
            ->map($toSetFormId)
            ->each($create);

        $toSetFormId = fn (FormFieldData $formField) => $formField->setFormId($form->getId());
        $create = fn (FormFieldData $formField) => $this->formFieldRepository->create($formField);
        collect($data->getFormFields())
            ->map($toSetFormId)
            ->each($create);

        return $this->repository->getOne(new FormIdFilter($form->getId()));
    }

    /**
     * @return FormUpdateData[]
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
        $form = $this->repository->update($data);

        $update = fn (FormUserUpdateData $formUser) => $this->formUserRepository->update($formUser);
        if (filled($form->getFormUsers())) collect($data->getFormUsers())->each($update);

        $update = fn (FormFieldUpdateData $formField) => $this->formFieldRepository->update($formField);
        if (filled($form->getFormFields())) collect($data->getFormFields())->each($update);

        return $form;
    }

    public function delete(FormFilter $filter): void
    {
        $this->repository->delete($filter);
    }

    public function getOneBySlug(FormFilter $filter): FormUpdateData
    {
        return $this->repository->getOneBySlug($filter);
    }
}