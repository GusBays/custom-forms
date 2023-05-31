<?php

namespace App\Repositories;

use App\Datas\Form\FormData;
use App\Datas\Form\FormUpdateData;
use App\Filters\Form\FormFilter;
use App\Http\Adapters\Form\FormModelAdapter;
use App\Interpreters\Form\FormIdInterpreter;
use App\Interpreters\Form\FormSlugInterpreter;
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
    private const RELATIONS = ['formUsers', 'formFields'];

    protected FormFieldRepository $formFieldRepository;

    public function __construct(
        Form $model
    )
    {
        $this->model = $model;
        $this->model->with(self::RELATIONS);

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

        $form->loadMissing(self::RELATIONS);

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

    public function getOneBySlug(FormFilter $filter): FormUpdateData
    {
        $form = $this->getFormQuery($filter)->firstOrFail();

        $form->loadMissing(self::RELATIONS);

        $data = new FormModelAdapter($form);

        config(['organization_id' => $data->getOrganizationId()]);

        $this->query = $this->model->newQuery();

        return $data;
    }

    private function getFormQuery(FormFilter $filter): Builder
    {
        $interpreters = [
            new FormIdInterpreter($filter),
            new FormSlugInterpreter($filter)
        ];

        foreach ($interpreters as $interpreter) {
            $interpreter->setQuery($this->query)->interpret();
        }

        return $this->query;
    }
}