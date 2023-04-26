<?php

namespace App\Services;

use App\Helpers\Validator;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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

    public function create(Request $request): Model
    {
        Validator::make($request)
            ->rules($this->repository->getModelRules())
            ->validateOrFail();

        return $this->repository->create($request->all());
    }

    public function getOne(int $id): Model
    {
        return $this->repository->getOne($id);
    }

    public function getPaginate(): Paginator
    {
        return $this->repository->getPaginate();
    }

    public function update(int $id, Request $request): Model
    {
        Validator::make($request)
            ->rules($this->repository->getModelRules())
            ->setId($id)
            ->validateOrFail();

        return $this->repository->update($id, $request->all());
    }
}