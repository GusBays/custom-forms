<?php

namespace App\Repositories;

use App\Datas\FormUser\FormUserData;
use App\Datas\FormUser\FormUserUpdateData;
use App\Filters\FormUser\FormUserFilter;
use App\Filters\FormUser\FormUserGetAllFilter;
use App\Filters\FormUser\FormUserIdFilter;
use App\Http\Adapters\FormUser\FormUserModelAdapter;
use App\Interpreters\FilterInterpreter;
use App\Interpreters\FormUser\FormUserIdInterpreter;
use App\Interpreters\SearchInterpreter;
use App\Interpreters\SortInterpreter;
use App\Models\FormUser;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class FormUserRepository
{
    protected FormUser $model;
    private const RELATIONS = ['form', 'user'];

    public function __construct(
        FormUser $model
    )
    {
        $this->model = $model;
    }

    public function create(FormUserData $data): FormUserUpdateData
    {
        $this->model->fill($data->toArray())->save();

        $data = new FormUserModelAdapter($this->model);

        $this->model->newInstance();

        return $data;
    }

    /**
     * @return FormUserUpdateData[]
     */
    public function getPaginate(): array
    {
        $formUsers = $this->getFormUserQuery(new FormUserGetAllFilter())->get();

        return FormUserModelAdapter::collection($formUsers);
    }

    public function update(FormUserUpdateData $data): FormUserUpdateData
    {
        $formUser = $this->getFormUserQuery(new FormUserIdFilter($data->getId()))->firstOrFail();

        $formUser->fill($data->onlyModifiedData())->save();

        return new FormUserModelAdapter($formUser);
    }

    public function delete(FormUserFilter $filter): void
    {
        $formUser = $this->getFormUserQuery($filter)->firstOrFail();

        if ($formUser->type === 'creator') throw new Exception('cannot_delete_creator_user');

        $formUser->delete();
    }

    private function getFormUserQuery(FormUserFilter $filter): Builder
    {
        $query = $this->model->newQuery();

        $interpreters = [
            new FormUserIdInterpreter($filter),
            new FilterInterpreter(),
            new SearchInterpreter(),
            new SortInterpreter()
        ];

        foreach ($interpreters as $interpreters) {
            $interpreters->setQuery($query)->interpret();
        }

        return $query;
    }
}