<?php

namespace App\Repositories;

use App\Datas\FormAnswer\FormAnswerData;
use App\Datas\FormAnswer\FormAnswerUpdateData;
use App\Filters\FormAnswer\FormAnswerFilter;
use App\Http\Adapters\FormAnswer\FormAnswerModelAdapter;
use App\Interpreters\FormAnswer\FormAnswerFillerIdInterpreter;
use App\Interpreters\FormAnswer\FormAnswerFormIdInterpreter;
use App\Models\FormAnswer;
use Illuminate\Database\Eloquent\Builder;

class FormAnswerRepository
{
    private FormAnswer $model;

    public function __construct(
        FormAnswer $model
    )
    {
        $this->model = $model;
    }

    public function create(FormAnswerData $data): FormAnswerUpdateData
    {
        $this->model->fill($data->toArray())->save();

        $data = new FormAnswerModelAdapter($this->model);

        $this->model->newInstance();
        
        return $data;
    }

    public function getOne(FormAnswerFilter $filter): FormAnswerUpdateData
    {
        $answer = $this->getFormAnswerQuery($filter)->firstOrFail();

        return new FormAnswerModelAdapter($answer);
    }

    public function getFormAnswersCount(FormAnswerFilter $filter): int
    {
        return $this->getFormAnswerQuery($filter)->get()->count();
    }

    private function getFormAnswerQuery(FormAnswerFilter $filter): Builder
    {
        $query = $this->model->newQuery();

        $interpreters = [
            new FormAnswerFormIdInterpreter($filter),
            new FormAnswerFillerIdInterpreter($filter),
        ];

        foreach ($interpreters as $interpreter) {
            $interpreter->setQuery($query)->interpret();
        }

        return $query;
    }
}