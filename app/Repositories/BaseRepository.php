<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    /** @var Model */
    protected $model;
    protected Builder $query;

    public function __construct(
        Model $model
    )
    {
        $this->model = $model;
        $this->query = $this->model->query();
    }

    public function create(array $data): Model
    {
        return $this->query->create($data);
    }

    public function getModelRules(): array
    {
        return $this->model->getRules();
    }
}