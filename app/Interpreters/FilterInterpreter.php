<?php

namespace App\Interpreters;

use App\Models\BaseModel;
use App\Models\Form;
use Illuminate\Database\Eloquent\Builder;

class FilterInterpreter extends DbInterpreter
{
    public function interpret(): Builder
    {
        $queryParams = collect(request()->query());

        if (blank($queryParams)) return $this->query;

        /** @var BaseModel */
        $model = $this->query->getModel();

        $modelFilterableFields = $model->getFilters();
        
        $byAllowedFilters = fn (string $value, string $field) => in_array($field, $modelFilterableFields);
        $toWhereClauses = fn (string $value, string $field) => [$field => $value];
        $fieldsToFilter = $queryParams->filter($byAllowedFilters)->mapWithKeys($toWhereClauses)->all();

        return $this->query->where($fieldsToFilter);
    }
}