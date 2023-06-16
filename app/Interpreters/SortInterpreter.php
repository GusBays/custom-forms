<?php

namespace App\Interpreters;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;

class SortInterpreter extends DbInterpreter
{
    public function interpret(): Builder
    {
        $sort = request()->query('sort');

        if (blank($sort)) return $this->query;

        /** @var BaseModel */
        $model = $this->query->getModel();

        $modelSortableFields = collect($model->getSorts());

        $isDesc = 0 === strpos($sort, '-');

        $sortDirection = $isDesc ? 'desc' : 'asc';

        $formattedRequestSortField = $isDesc ? str_replace('-', '', $sort) : $sort;

        $byEqualField = fn (string $field) => $field === $formattedRequestSortField;
        $sortField = $modelSortableFields->first($byEqualField);

        if (blank($sortField)) return $this;

        return $this->query->orderBy($sortField, $sortDirection);
    }
}