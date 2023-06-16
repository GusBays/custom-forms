<?php

namespace App\Interpreters;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;

class SearchInterpreter extends DbInterpreter
{
    public function interpret(): Builder
    {
        $search = request()->query('q');

        if (blank($search)) return $this->query;

        /** @var BaseModel */
        $model = $this->query->getModel();

        $modelSearchableFields = collect($model->getSearch());

        $addOrWhere = fn (string $field) => $this->query->orWhere($field, 'LIKE', "%$search%");
        $modelSearchableFields->each($addOrWhere);

        return $this->query;
    }
}