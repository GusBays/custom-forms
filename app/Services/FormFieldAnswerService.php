<?php

namespace App\Services;

use App\Datas\FormFieldAnswer\FormFieldAnswerData;
use App\Datas\FormFieldAnswer\FormFieldAnswerUpdateData;
use App\Filters\Form\FormIdFilter;
use App\Jobs\FillNotificationJob;
use App\Repositories\FormFieldAnswerRepository;
use App\Repositories\FormRepository;

class FormFieldAnswerService
{
    private FormFieldAnswerRepository $repository;
    private FormRepository $formRepository;

    public function __construct(
        FormFieldAnswerRepository $repository,
        FormRepository $formRepository
    )
    {
        $this->repository = $repository;
        $this->formRepository = $formRepository;
    }

    public function create(FormFieldAnswerData $data): FormFieldAnswerUpdateData
    {
        return $this->repository->create($data);
    }

    /**
     * @param FormFieldAnswerData[] $answers
     */
    public function createFromArray(array $answers): array
    {
        /** @var FormFieldAnswerData */
        $firstAnswer = collect($answers)->first();
        $form = $this->formRepository->getOne(new FormIdFilter($firstAnswer->getFormId()));

        $toCreate = fn (FormFieldAnswerData $formFieldAnswerData) => $this->create($formFieldAnswerData);
        $formFieldAnswersUpdateDataArray = collect($answers)->map($toCreate);

        //if ($form->getShouldNotifyEachFill()) dispatch(new FillNotificationJob($form));

        return $formFieldAnswersUpdateDataArray->all();
    }
}