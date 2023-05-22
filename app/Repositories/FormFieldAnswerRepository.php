<?php

namespace App\Repositories;

use App\Datas\Form\FormUpdateData;
use App\Datas\FormFieldAnswer\FormFieldAnswerData;
use App\Datas\FormFieldAnswer\FormFieldAnswerUpdateData;
use App\Http\Adapters\FormFieldAnswer\FormFieldAnswerModelAdapter;
use App\Models\FormFieldAnswer;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\Response;

class FormFieldAnswerRepository
{
    private FormFieldAnswer $model;
    private Builder $query;

    public function __construct(
        FormFieldAnswer $model
    )
    {
        $this->model = $model;
        $this->query = $model->query();
    }

    public function create(FormFieldAnswerData $data): FormFieldAnswerUpdateData
    {
        $formFieldAnswer = $this->query->create($data->toArray());

        $this->query = $this->model->newQuery();

        return new FormFieldAnswerModelAdapter($formFieldAnswer);
    }

    public function checkIfAnswerIsAlreadyRegistered(FormFieldAnswerData $data): void
    {
        $answer = $this->query
            ->where('form_id', $data->getFormId())
            ->where('field_id', $data->getFieldId())
            ->where('filler_id', $data->getFillerId())
            ->get();

        $this->query = $this->model->newQuery();
        
        if (filled($answer)) throw new Exception('answer_already_registered', Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function hasExceededFillLimitOn(FormUpdateData $form): bool
    {
        if (blank($form->getFillLimit())) return false;

        $formAnswersCount = $this->query
            ->where('form_id', $form->getId())
            ->get()
            ->unique('filler_id')
            ->count();

        $this->query = $this->model->newQuery();

        if ($formAnswersCount >= $form->getFillLimit()) return true;

        return false;
    }
}