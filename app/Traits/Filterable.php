<?php

namespace App\Traits;

trait Filterable
{
    protected function filter()
    {
        $queryParams = collect(request()->query());

        if (blank($queryParams)) return $this;

        $modelFilterableFields = $this->model->getFilters();
        
        $byAllowedFilters = fn (string $value, string $field) => in_array($field, $modelFilterableFields);
        $toWhereClauses = fn (string $value, string $field) => [$field => $value];
        $fieldsToFilter = $queryParams->filter($byAllowedFilters)->mapWithKeys($toWhereClauses)->all();

        $this->query->where($fieldsToFilter);

        return $this;
    }
}