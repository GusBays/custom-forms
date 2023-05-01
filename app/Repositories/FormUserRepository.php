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
        $this->model->fill($data->toArray())->save();

        return new FormUserModelAdapter($this->model);
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

    public function createFirstFormUser(int $form_id): FormUser
    {
        $this->model->form_id = $form_id;
        $this->model->user_id = config('user_id');
        $this->model->type = 'creator';

        $this->model->save();

        return $this->model;
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