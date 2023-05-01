<?php

namespace App\Repositories;

use App\Datas\Form\FormData;
use App\Datas\Form\FormUpdateData;
use App\Filters\Form\FormFilter;
use App\Http\Adapters\Form\FormModelAdapter;
use App\Interpreters\Form\FormIdInterpreter;
use App\Models\Form;
use App\Traits\Filterable;
use App\Traits\PerPage;
use App\Traits\Searchable;
use App\Traits\Sortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FormRepository
{
    use Filterable;
    use Searchable;
    use Sortable;
    use PerPage;

    protected Form $model;
    protected Builder $query;
    private const RELATIONS = ['formUsers'];

    public function __construct(
        Form $model
    )
    {
        $this->model = $model;
        $this->query = $model->query();

        $this->query->with(self::RELATIONS);
    }

    public function create(FormData $data): FormUpdateData
    {
        $this->model->fill($data->toArray())->save();

        return new FormModelAdapter($this->model);
    }

    /**
     * @var FormUpdateData[]
     */
    public function getPaginate(Request $request): ?array
    {
        $forms = $this->filter()
            ->search()
            ->sort()
            ->query
            ->paginate($this->perPage())
            ->items();

        return FormModelAdapter::collection($forms);
    }

    public function getOne(FormFilter $filter): FormUpdateData
    {
        $form = $this->getFormQuery($filter)->firstOrFail();

        return new FormModelAdapter($form);
    }

    public function update(FormUpdateData $data): FormUpdateData
    {
        $form = $this->query->findOrFail($data->getId());

        $form->fill($data->onlyModifiedData())->save();

        return new FormModelAdapter($form);
    }

    public function delete(FormFilter $filter): void
    {
        $form = $this->getFormQuery($filter)->firstOrFail();

        $form->delete();
    }

    private function getFormQuery(FormFilter $filter): Builder
    {
        $interpreters = [
            new FormIdInterpreter($filter),
        ];

        foreach ($interpreters as $interpreter) {
            $interpreter->setQuery($this->query)->interpret();
        }

        return $this->query;
    }
}