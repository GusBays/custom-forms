<?php

namespace App\Repositories;

use App\Filters\FormAnswer\FormAnswerFilter;
use App\Http\Adapters\FormAnswer\FormAnswerModelAdapter;
use App\Interpreters\FormAnswer\FormAnswerFillerIdInterpreter;
use App\Interpreters\FormAnswer\FormAnswerFormIdInterpreter;
use App\Models\FormAnswer;
use Illuminate\Database\Eloquent\Builder;

class ReportRepository
{
    private FormAnswer $model;

    public function __construct(
        FormAnswer $model
    )
    {
        $this->model = $model;
    }

    /**
     * @return FormAnswerUpdateData[]
     */
    public function getAnswersBy(FormAnswerFilter $filter): array
    {
        $answers = $this->getFormAnswerQuery($filter)->get();

        return $answers
            ->mapInto(FormAnswerModelAdapter::class)
            ->all();
    }

    private function getFormAnswerQuery(FormAnswerFilter $filter): Builder
    {
        $query = $this->model->newQuery();

        $interpreters = [
            new FormAnswerFillerIdInterpreter($filter),
            new FormAnswerFormIdInterpreter($filter)
        ];

        foreach ($interpreters as $interpreter) {
            $interpreter->setQuery($query)->interpret();
        }

        return $query;
    }
}