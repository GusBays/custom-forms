<?php

namespace App\Services;

use App\Datas\Form\FormUpdateData;
use App\Datas\FormFieldAnswer\FormFieldAnswerData;
use App\Datas\FormFieldAnswer\FormFieldAnswerUpdateData;
use App\Filters\Filler\FillerEmailFilter;
use App\Filters\Form\FormIdFilter;
use App\Jobs\AnswerNotificationJob;
use App\Jobs\FillNotificationJob;
use App\Repositories\FillerRepository;
use App\Repositories\FormFieldAnswerRepository;
use App\Repositories\FormRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

class FormFieldAnswerService
{
    private FormFieldAnswerRepository $repository;
    private FillerRepository $fillerRepository;
    private FormRepository $formRepository;

    public function __construct(
        FormFieldAnswerRepository $repository,
        FillerRepository $fillerRepository,
        FormRepository $formRepository
    )
    {
        $this->repository = $repository;
        $this->fillerRepository = $fillerRepository;
        $this->formRepository = $formRepository;
    }

    public function create(FormFieldAnswerData $data): FormFieldAnswerUpdateData
    {
        return $this->repository->create($data);
    }

    /**
     * @return FormFieldAnswerData[]
     */
    public function createFromArray(array $answers): array
    {
        /** @var FormFieldAnswerData */
        $firstAnswer = collect($answers)->first();

        try {
            $filler = $this->fillerRepository->getOne(new FillerEmailFilter($firstAnswer->getFiller()->getEmail()));
        } catch (ModelNotFoundException $e) {
            $filler = null;
        }

        if (blank($filler)) $filler = $this->fillerRepository->create($firstAnswer->getFiller())->getId();

        $form = $this->formRepository->getOne(new FormIdFilter($firstAnswer->getFormId()));

        $this->checkIfCanAnswer($form);

        $toSetFillerId = fn (FormFieldAnswerData $formFieldAnswerData) => $formFieldAnswerData->setFillerId($filler->getId());
        $checkIfExists = fn (FormFieldAnswerData $formFieldAnswerData) => $this->repository->checkIfAnswerIsAlreadyRegistered($formFieldAnswerData);
        $toCreate = fn (FormFieldAnswerData $formFieldAnswerData) => $this->create($formFieldAnswerData);
        $formFieldAnswersUpdateDataArray = collect($answers)
            ->map($toSetFillerId)
            ->each($checkIfExists)
            ->map($toCreate)
            ->all();

        //if ($form->getShouldNotifyEachFill()) dispatch(new FillNotificationJob($form));

        //dispatch(new AnswerNotificationJob($form, $filler));

        return $formFieldAnswersUpdateDataArray;
    }

    private function checkIfCanAnswer(FormUpdateData $form): void
    {
        if ($this->repository->hasExceededFillLimitOn($form)) throw new \Exception('fill_limit_exceeded', Response::HTTP_INTERNAL_SERVER_ERROR);

        if (filled($form->getAvailableUntil()) && Carbon::now()->isAfter($form->getAvailableUntil())) throw new \Exception('form_is_no_longer_available', Response::HTTP_INTERNAL_SERVER_ERROR);

        if (false === $form->getActive()) throw new \Exception('cannot_answer_inactive_form');
    }
}