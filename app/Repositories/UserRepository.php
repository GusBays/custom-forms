<?php

namespace App\Repositories;

use App\Datas\User\UserData;
use App\Datas\User\UserUpdateData;
use App\Filters\User\UserFilter;
use App\Filters\User\UserGetAllFilter;
use App\Filters\User\UserIdFilter;
use App\Http\Adapters\User\UserModelAdapter;
use App\Interpreters\FilterInterpreter;
use App\Interpreters\SearchInterpreter;
use App\Interpreters\SortInterpreter;
use App\Interpreters\User\UserEmailInterpreter;
use App\Interpreters\User\UserIdInterpreter;
use App\Interpreters\User\UserTokenInterpreter;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\Response;

class UserRepository
{
    protected User $model;

    public function __construct(
        User $model
    )
    {
        $this->model = $model;
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
        $users = $this->getUserQuery(new UserGetAllFilter())->get();

        return UserModelAdapter::collection($users);
    }

    public function getOne(UserFilter $filter): UserUpdateData
    {
        $user = $this->getUserQuery($filter)->firstOrFail();

        return new UserModelAdapter($user);
    }

    public function update(UserUpdateData $data): UserUpdateData
    {
        $user = $this->getUserQuery(new UserIdFilter($data->getId()))->firstOrFail();

        $user->fill($data->onlyModifiedData())->save();

        return new UserModelAdapter($user);
    }

    public function delete(UserFilter $filter): void
    {
        $user = $this->getUserQuery($filter)->firstOrFail();

        if ('owner' === $user->type) throw new \Throwable('cannot_delete_owner_user');

        $user->delete();
    }

    public function getByToken(UserFilter $filter): UserUpdateData
    {
        $user = $this->getUserQuery($filter)->firstOrFail();

        return new UserModelAdapter($user);
    }

    public function getNotifiableInstance(UserFilter $filter): User
    {
        return $this->getUserQuery($filter)->firstOrFail();
    }

    public function createFirstUser(UserData $data): UserModelAdapter
    {
        $query = $this->model->newQueryWithoutScopes();

        if ($query->where('organization_id', config('organization_id'))->exists()) throw new \Throwable('organization_already_have_user', Response::HTTP_INTERNAL_SERVER_ERROR);

        $user = $query->create($data->toArray());

        return new UserModelAdapter($user);
    }

    public function createJwtToken(User $user): string
    {
        return (new JWT)->encode([
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'organization_id' => config('organization_id')
        ], 
        env('APP_KEY'),
        'HS256');
    }

    private function getUserQuery(UserFilter $filter): Builder
    {
        $query = $this->model->newQuery();

        $interpreters = [
            new UserTokenInterpreter($filter),
            new UserEmailInterpreter($filter),
            new UserIdInterpreter($filter),
            new FilterInterpreter(),
            new SearchInterpreter(),
            new SortInterpreter(),
        ];
        
        foreach ($interpreters as $interpreter) {
            $interpreter->setQuery($query)->interpret();
        }

        return $query;
    }
}