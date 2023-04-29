<?php

namespace App\Services;

use App\Repositories\FormUserRepository;

class FormUserService extends BaseService
{
    protected $repository;

    public function __construct(
        FormUserRepository $repository
    )
    {
        $this->repository = $repository;
    }
}