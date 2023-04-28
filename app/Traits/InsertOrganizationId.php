<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait InsertOrganizationId
{
    protected static function bootInsertOrganizationId()
    {
        /** @var Model $this */
        static::creating(function (Model $model) {
            $model->setAttribute($model->getTable() . '.organization_id', config('organization_id'));
        });
    }
}