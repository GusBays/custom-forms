<?php

namespace App\Services;

use App\Repositories\FormRepository;

class FormService extends BaseService
{
    protected $repository;

    public function __construct(
        FormRepository $repository
    )
    {
        $this->repository = $repository;
    }
}