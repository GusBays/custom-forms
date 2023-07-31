<?php

namespace App\Services;

use App\Datas\Form\FormUpdateData;
use App\Datas\FormAnswer\FormAnswerData;
use App\Datas\FormAnswer\FormAnswerUpdateData;
use App\Filters\Filler\FillerEmailFilter;
use App\Filters\Filler\FillerIdFilter;
use App\Filters\Form\FormIdFilter;
use App\Filters\FormAnswer\FormAnswerFormIdFilter;
use App\Http\Adapters\Filler\FillerRequestAdapter;
use App\Jobs\AnswerNotificationJob;
use App\Jobs\FillNotificationJob;
use App\Repositories\FillerRepository;
use App\Repositories\FormAnswerRepository;
use App\Repositories\FormRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FormAnswerService
{
    private FormAnswerRepository $repository;
    private FillerRepository $fillerRepository;
    private FormRepository $formRepository;

    public function __construct(
        FormAnswerRepository $repository,
        FillerRepository $fillerRepository,
        FormRepository $formRepository
    )
    {
        $this->repository = $repository;
        $this->fillerRepository = $fillerRepository;
        $this->formRepository = $formRepository;
    }

    public function create(FormAnswerData $data, string $email): FormAnswerUpdateData
    {
        try {
            $filler = $this->fillerRepository->getOne(new FillerEmailFilter($email));
        } catch (ModelNotFoundException $th) {
            $filler = $this->fillerRepository->create(new FillerRequestAdapter(new Request(['email' => $email])));
        }

        $data->setFillerId($filler->getId());

        $form = $this->formRepository->getOne(new FormIdFilter($data->getFormId()));

        $this->checkIfCanAnswer($form);

        $answer = $this->repository->create($data);

        // if ($form->getShouldNotifyEachFill()) dispatch(new FillNotificationJob($form, $filler, $answer));

        // dispatch(new AnswerNotificationJob($form, $filler));

        return $answer;
    }

    private function checkIfCanAnswer(FormUpdateData $form): void
    {
        if ($this->hasExceededFillLimitOn($form)) throw new \Exception('fill_limit_exceeded', Response::HTTP_INTERNAL_SERVER_ERROR);

        if (filled($form->getAvailableUntil()) && Carbon::now()->isAfter($form->getAvailableUntil())) throw new \Exception('form_is_no_longer_available', Response::HTTP_INTERNAL_SERVER_ERROR);

        if (false === $form->getActive()) throw new \Exception('cannot_answer_inactive_form');
    }

    private function hasExceededFillLimitOn(FormUpdateData $form): bool
    {
        if (blank($form->getFillLimit())) return false;

        $answersCount = $this->repository->getFormAnswersCount(new FormAnswerFormIdFilter($form->getId()));

        if ($answersCount >= $form->getFillLimit()) return true;
    }
}