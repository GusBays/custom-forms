<?php

namespace App\Traits;

trait Searchable
{
    protected function search()
    {
        $search = request()->query('q');

        if (blank($search)) return $this;

        $modelSearchableFields = collect($this->model->getSearch());

        $toAddOrWhere = fn (string $field) => $this->query->orWhere($field, 'LIKE', "%$search%");
        $modelSearchableFields->map($toAddOrWhere);

        return $this;
    }
}