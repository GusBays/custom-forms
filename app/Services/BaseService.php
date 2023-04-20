<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $data = $request->all();

        Validator::make($data, $this->repository->getModelRules())->validate();

        return $this->repository->create($request->all());
    }
}