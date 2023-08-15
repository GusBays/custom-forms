<?php

namespace App\Repositories;

use App\Datas\Form\FormData;
use App\Datas\Form\FormUpdateData;
use App\Filters\Form\FormFilter;
use App\Filters\Form\FormGetAllFilter;
use App\Filters\Form\FormIdFilter;
use App\Http\Adapters\Form\FormModelAdapter;
use App\Interpreters\FilterInterpreter;
use App\Interpreters\Form\FormIdInterpreter;
use App\Interpreters\Form\FormSlugInterpreter;
use App\Interpreters\SearchInterpreter;
use App\Interpreters\SortInterpreter;
use App\Models\Form;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FormRepository
{
    protected Form $model;
    private const RELATIONS = ['formUsers', 'formFields'];

    protected FormFieldRepository $formFieldRepository;

    public function __construct(
        Form $model
    )
    {
        $this->model = $model;
        $this->model->with(self::RELATIONS);
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
        $forms = $this->getFormQuery(new FormGetAllFilter())->get();

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
        $form = $this->getFormQuery(new FormIdFilter($data->getId()))->firstOrFail();

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

        return $data;
    }

    private function getFormQuery(FormFilter $filter): Builder
    {
        $query = $this->model->newQuery();

        $interpreters = [
            new FormIdInterpreter($filter),
            new FormSlugInterpreter($filter),
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