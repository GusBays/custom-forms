<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class OrganizationScope implements Scope
{
    public function apply(Builder $query, Model $model)
    {
        if (blank(config('organization_id'))) return;

        $query->where('organization_id', config('organization_id'));
    }
}