<?php

namespace App\Repositories;

use App\Datas\FormFieldAnswer\FormFieldAnswerData;
use App\Datas\FormFieldAnswer\FormFieldAnswerUpdateData;
use App\Filters\FormFieldAnswer\FormFieldAnswerFilter;
use App\Http\Adapters\FormFieldAnswer\FormFieldAnswerModelAdapter;
use App\Interpreters\FormFieldAnswer\FormFieldAnswerFieldIdInterpreter;
use App\Interpreters\FormFieldAnswer\FormFieldAnswerFillerIdInterpreter;
use App\Interpreters\FormFieldAnswer\FormFieldAnswerFormIdInterpreter;
use App\Models\FormFieldAnswer;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\Response;

class FormFieldAnswerRepository
{
    private FormFieldAnswer $model;

    public function __construct(
        FormFieldAnswer $model
    )
    {
        $this->model = $model;
    }

    public function create(FormFieldAnswerData $data): FormFieldAnswerUpdateData
    {
        $this->model->fill($data->toArray())->save();

        $data = new FormFieldAnswerModelAdapter($this->model);

        $this->model->newInstance();
        
        return $data;
    }

    /**
     * @return FormFieldAnswerUpdateData[]
     */
    public function getAnswersBy(FormFieldAnswerFilter $filter): array
    {
        return $this->getFormFieldAnswerQuery($filter)
            ->get()
            ->mapInto(FormFieldAnswerModelAdapter::class)
            ->all();
    }

    public function checkIfAnswerIsAlreadyRegistered(FormFieldAnswerFilter $filter): void
    {
        $answer = $this->getFormFieldAnswerQuery($filter)->first();

        if (blank($answer)) return;

        throw new Exception('answer_already_registered', Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function getFormAnswersCount(FormFieldAnswerFilter $filter): int
    {
        return $this->getFormFieldAnswerQuery($filter)
            ->get()
            ->unique('filler_id')
            ->count();
    }

    private function getFormFieldAnswerQuery(FormFieldAnswerFilter $filter): Builder
    {
        $query = $this->model->newQuery();

        $interpreters = [
            new FormFieldAnswerFormIdInterpreter($filter),
            new FormFieldAnswerFillerIdInterpreter($filter),
            new FormFieldAnswerFieldIdInterpreter($filter)
        ];

        foreach ($interpreters as $interpreter) {
            $interpreter->setQuery($query)->interpret();
        }

        return $query;
    }
}