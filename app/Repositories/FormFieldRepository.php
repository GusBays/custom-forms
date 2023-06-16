<?php

namespace App\Repositories;

use App\Datas\FormField\FormFieldData;
use App\Datas\FormField\FormFieldUpdateData;
use App\Filters\FormField\FormFieldFilter;
use App\Filters\FormField\FormFieldGetAllFilter;
use App\Filters\FormField\FormFieldIdFilter;
use App\Http\Adapters\FormField\FormFieldModelAdapter;
use App\Interpreters\FilterInterpreter;
use App\Interpreters\FormField\FormFieldIdInterpreter;
use App\Interpreters\SearchInterpreter;
use App\Interpreters\SortInterpreter;
use App\Models\FormField;
use App\Traits\PerPage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FormFieldRepository
{
    use PerPage;

    protected FormField $model;

    public function __construct(
        FormField $model
    )
    {
        $this->model = $model;
    }

    public function create(FormFieldData $data): FormFieldUpdateData
    {
        $formField = $this->getFormFieldQuery(new FormFieldGetAllFilter())
            ->create($data->toArray());

        return new FormFieldModelAdapter($formField);
    }

    /**
     * @return FormFieldUpdateData[]
     */
    public function getPaginate(Request $request): array
    {
        $formFields = $this->getFormFieldQuery(new FormFieldGetAllFilter())
            ->paginate($this->perPage())
            ->items();

        return FormFieldModelAdapter::collection($formFields);
    }

    public function getOne(FormFieldFilter $filter): FormFieldUpdateData
    {
        $formField = $this->getFormFieldQuery($filter)->firstOrFail();

        return new FormFieldModelAdapter($formField);
    }

    public function update(FormFieldUpdateData $data): FormFieldUpdateData
    {
        $formField = $this->getFormFieldQuery(new FormFieldIdFilter($data->getId()))->firstOrFail();

        $formField->fill($data->onlyModifiedData())->save();

        return new FormFieldModelAdapter($formField);
    }

    public function delete(FormFieldFilter $filter): void
    {
        $formField = $this->getFormFieldQuery($filter)->firstOrFail();

        $formField->delete();
    }

    private function getFormFieldQuery(FormFieldFilter $filter): Builder
    {
        $query = $this->model->newQuery();

        $interpreters = [
            new FormFieldIdInterpreter($filter),
            new FilterInterpreter(),
            new SearchInterpreter(),
            new SortInterpreter()
        ];

        foreach ($interpreters as $interpreter) {
            $interpreter->setQuery($query)->interpret();
        }

        return $query;
    }
}