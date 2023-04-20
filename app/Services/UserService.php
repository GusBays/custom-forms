<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\BaseService;

class UserService extends BaseService
{
    /** @var UserRepository */
    protected $repository;

    public function __construct(
        UserRepository $repository
    )
    {
        $this->repository = $repository;
    }
}