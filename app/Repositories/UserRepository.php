<?php

namespace App\Repositories;

use App\Datas\User\UserData;
use App\Datas\User\UserUpdateData;
use App\Filters\User\UserFilter;
use App\Http\Adapters\User\UserModelAdapter;
use App\Interpreters\User\UserEmailInterpreter;
use App\Interpreters\User\UserIdInterpreter;
use App\Interpreters\User\UserTokenInterpreter;
use App\Models\User;
use App\Traits\Filterable;
use App\Traits\PerPage;
use App\Traits\Searchable;
use App\Traits\Sortable;
use Firebase\JWT\JWT;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\Response;

class UserRepository
{
    use Filterable;
    use Searchable;
    use Sortable;
    use PerPage;

    protected User $model;
    protected Builder $query;

    public function __construct(
        User $model
    )
    {
        $this->model = $model;
        $this->query = $model->query();
    }

    public function create(UserData $data): UserUpdateData
    {
        $this->model->fill($data->toArray())->save();
        
        return new UserModelAdapter($this->model);
    }

    /**
     * @return UserUpdateData[]
     */
    public function getPaginate(): ?array
    {
        $users = $this->filter()
            ->search()
            ->sort()
            ->query
            ->paginate($this->perPage())
            ->items();

        return UserModelAdapter::collection($users);
    }

    public function getOne(UserFilter $filter): UserUpdateData
    {
        $user = $this->getUserQuery($filter)->firstOrFail();

        return new UserModelAdapter($user);
    }

    public function update(UserUpdateData $data): UserUpdateData
    {
        $user = $this->query->findOrFail($data->getId());

        $user->fill($data->onlyModifiedData())->save();

        return new UserModelAdapter($user);
    }

    public function delete(UserFilter $filter): void
    {
        $user = $this->getUserQuery($filter)->firstOrFail();

        $user->delete();
    }

    public function getByEmail(UserFilter $filter): UserUpdateData
    {
        $user = $this->getUserQuery($filter)->firstOrFail();

        return new UserModelAdapter($user);
    }

    public function getByToken(UserFilter $filter): UserUpdateData
    {
        $user = $this->getUserQuery($filter)->firstOrFail();

        return new UserModelAdapter($user);
    }

    public function createFirstUser(UserData $data): User
    {
        $query = $this->model->newQueryWithoutScopes();

        if ($query->where('organization_id', config('organization_id'))->exists()) throw new \Throwable('organization_already_have_user', Response::HTTP_INTERNAL_SERVER_ERROR);
        
        $this->model->fill($data->toArray())->save();

        return $this->model;
    }

    public function createJwtToken(User $user): string
    {
        return (new JWT)->encode([
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'organization_id' => $user->organization_id
        ], 
        env('APP_KEY'),
        'HS256');
    }

    private function getUserQuery(UserFilter $filter): Builder
    {
        $interpreters = [
            new UserTokenInterpreter($filter),
            new UserEmailInterpreter($filter),
            new UserIdInterpreter($filter)
        ];
        
        foreach ($interpreters as $interpreter) {
            $interpreter->setQuery($this->query)->interpret();
        }

        return $this->query;
    }
}