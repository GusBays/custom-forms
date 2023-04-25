<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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
        $model = $this->query->create($data);

        $this->resetModelInstance();

        return $model;
    }

    public function getOne(int $id): Model
    {
        $model = $this->query->findOrFail($id);

        $this->getNewQuery();

        return $model;
    }

    public function getPaginate(): Paginator
    {
        $models = $this->filter()
            ->query
            ->simplePaginate($this->model->getPerPage());

        $this->getNewQuery();

        return $models;
    }

    protected function resetModelInstance(): void
    {
        $this->model = $this->model->newInstance();
    }

    public function getModelRules(): array
    {
        return $this->model->getRules();
    }

    protected function getOneByOrFail(string $field, $value): Model
    {
        $this->whereBy(...func_get_args());

        try {
            $model = $this->query->firstOrFail();
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            $this->getNewQuery();
        }

        return $model;
    }

    protected function getNewQuery(): void
    {
        $this->model = app($this->model->getMorphClass());
        $this->query = $this->model->query();

        $this->bootQuery();
    }

    protected function bootQuery(): void
    {
        $this->query->addSelect($this->model->getTable() . '.*');
    }

    protected function whereBy(string $field, $value = null)
    {
        $this->query->where($field, $value);
    }

    private function filter(): self
    {
        $queryParams = collect(request()->query());
        $modelFilterableFields = $this->model->getFilters();
        
        $byAllowedFilters = fn (string $value, string $field) => in_array($field, $modelFilterableFields);
        $toWhereClauses = fn (string $value, string $field) => [$field => $value];
        $fieldsToFilter = $queryParams->filter($byAllowedFilters)->mapWithKeys($toWhereClauses)->all();

        $this->query->where($fieldsToFilter);

        return $this;
    }
}