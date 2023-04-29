<?php

namespace App\Traits;

trait Sortable
{
    protected function sort()
    {
        $sort = request()->query('sort');

        if (blank($sort)) return $this;

        $modelSortableFields = collect($this->model->getSorts());

        $isDesc = 0 === strpos($sort, '-');

        $sortDirection = $isDesc ? 'desc' : 'asc';

        $formattedRequestSortField = $isDesc ? str_replace('-', '', $sort) : $sort;

        $byEqualField = fn (string $field) => $field === $formattedRequestSortField;
        $sortField = $modelSortableFields->first($byEqualField);

        if (blank($sortField)) return $this;

        $this->query->orderBy($sortField, $sortDirection);

        return $this;
    }
}