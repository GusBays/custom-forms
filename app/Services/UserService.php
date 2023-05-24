<?php

namespace App\Services;

use App\Datas\User\UserData;
use App\Datas\User\UserUpdateData;
use App\Filters\User\UserEmailFilter;
use App\Filters\User\UserFilter;
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

    public function login(Request $request): UserUpdateData
    {
        $user = $this->repository->getByEmail(new UserEmailFilter($request));

        if (!Hash::check($request->password, $user->getPassword())) throw new Exception('invalid_password', Response::HTTP_UNAUTHORIZED);

        config(['organization_id' => $user->getOrganizationId()]);

        return $user;
    }
}