<?php

namespace App\Services;

use App\Datas\User\UserData;
use App\Datas\User\UserUpdateData;
use App\Filters\User\UserEmailFilter;
use App\Filters\User\UserFilter;
use App\Http\Adapters\User\UserPasswordUpdateAdapter;
use App\Http\Adapters\User\UserRequestUpdateAdapter;
use App\Jobs\RecoverPasswordJob;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserService
{
    protected UserRepository $repository;

    public function __construct(
        UserRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function create(UserData $data): UserUpdateData
    {
        return $this->repository->create($data);
    }

    /**
     * @return UserUpdateData[]
     */
    public function getPaginate(Request $request): ?array
    {
        return $this->repository->getPaginate($request);
    }

    public function getOne(UserFilter $filter): UserUpdateData
    {
        return $this->repository->getOne($filter);
    }

    public function update(UserUpdateData $data): UserUpdateData
    {
        return $this->repository->update($data);
    }

    public function delete(UserFilter $filter): void
    {
        $this->repository->delete($filter);
    }

    public function login(UserData $data): UserUpdateData
    {
        $user = $this->repository->getOne(new UserEmailFilter($data->getEmail()));

        if (!Hash::check($data->getPassword(), $user->getPassword())) throw new Exception('invalid_password', Response::HTTP_UNAUTHORIZED);

        config(['organization_id' => $user->getOrganizationId()]);

        return $user;
    }

    public function recoverPassword(UserData $data): void
    {
        $newPassword = bin2hex(random_bytes(6));

        $user = $this->repository->getOne(new UserEmailFilter($data->getEmail()));

        $user = $this->repository->update(new UserPasswordUpdateAdapter($user->getId(), $newPassword));

        dispatch(new RecoverPasswordJob($user, $newPassword));
    }
}