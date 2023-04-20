<?php

namespace App\Services;

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
        return $this->repository->create($request->all());
    }
}