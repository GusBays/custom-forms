<?php

namespace App\Repositories;

use App\Datas\FormUser\FormUserData;
use App\Datas\FormUser\FormUserUpdateData;
use App\Filters\FormUser\FormUserFilter;
use App\Http\Adapters\FormUser\FormUserModelAdapter;
use App\Interpreters\FormUser\FormUserIdInterpreter;
use App\Models\Form;
use App\Models\FormUser;
use App\Traits\Filterable;
use App\Traits\PerPage;
use App\Traits\Searchable;
use App\Traits\Sortable;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class FormUserRepository
{
    use Filterable;
    use Searchable;
    use Sortable;
    use PerPage;

    protected FormUser $model;
    protected Builder $query;

    public function __construct(
        FormUser $model
    )
    {
        $this->model = $model;

        $this->query = $model->query();
    }

    public function create(FormUserData $data): FormUserUpdateData
    {
        $user = $this->query->create($data->toArray());

        $this->query = $this->model->newQuery();

        return new FormUserModelAdapter($user);
    }

    /**
     * @return FormUserUpdateData[]
     */
    public function getPaginate(): array
    {
        $formUsers = $this->filter()
            ->search()
            ->sort()
            ->query
            ->paginate($this->perPage())
            ->items();

        return FormUserModelAdapter::collection($formUsers);
    }

    public function update(FormUserUpdateData $data): FormUserUpdateData
    {
        $formUser = $this->query->findOrFail($data->getId());

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
        $interpreters = [
            new FormUserIdInterpreter($filter)
        ];

        foreach ($interpreters as $interpreters) {
            $interpreters->setQuery($this->query)->interpret();
        }

        return $this->query;
    }
}