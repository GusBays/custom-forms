<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait MountName
{
    protected static function bootMountName()
    {
        static::saving(function (Model $model) {
            $name = $model->first_name;

            if (filled($model->last_name)) $name = $name . ' ' . $model->last_name;

            $model->setAttribute('name', $name);
        });
    } 
}