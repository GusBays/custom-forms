<?php

namespace App\Services;

use App\Helpers\Validator;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class BaseService
{
    /** @var BaseRepository */
    protected $repository;

    public function __construct(
        BaseRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function create(Request $request): array
    {
        Validator::make($request)
            ->rules($this->repository->getModelRules())
            ->validateOrFail();

        return $this->repository->create($request->all());
    }
}