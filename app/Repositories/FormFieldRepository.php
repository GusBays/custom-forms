<?php

namespace App\Repositories;

use App\Datas\FormField\FormFieldData;
use App\Datas\FormField\FormFieldUpdateData;
use App\Filters\FormField\FormFieldFilter;
use App\Http\Adapters\FormField\FormFieldModelAdapter;
use App\Interpreters\FormField\FormFieldIdInterpreter;
use App\Models\FormField;
use App\Traits\Filterable;
use App\Traits\PerPage;
use App\Traits\Searchable;
use App\Traits\Sortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FormFieldRepository
{
    use Filterable;
    use Searchable;
    use Sortable;
    use PerPage;

    protected FormField $model;
    protected Builder $query;

    public function __construct(
        FormField $model
    )
    {
        $this->model = $model;

        $this->query = $model->query();
    }

    public function create(FormFieldData $data): FormFieldUpdateData
    {
        $this->model->fill($data->toArray())->save();

        return new FormFieldModelAdapter($this->model);
    }

    /**
     * @return FormFieldUpdateData[]
     */
    public function getPaginate(Request $request): array
    {
        $formFields = $this->filter()
            ->search()
            ->sort()
            ->query
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
        $formField = $this->query->findOrFail($data->getId());

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
        $interpreters = [
            new FormFieldIdInterpreter($filter)
        ];

        foreach ($interpreters as $interpreter) {
            $interpreter->setQuery($this->query)->interpret();
        }

        return $this->query;
    }
}