<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\SUpport\Str;

class Organization extends BaseModel
{
    protected array $rules = [
        'name' => 'required|max:255',
        'email' => 'required|unique:users|max:255',
        'first_name' => 'required|max:255',
        'last_name' => 'nullable|max:255',
        'password' => 'required|min:6|max:255',
    ];

    protected $fillable = [
        'name',
    ];

    protected array $search = [
        'name',
        'slug'
    ];

    public static function boot()
    {
        parent::boot();

        static::query()->withoutGlobalScope('withOrganizationId');

        static::creating(function (Model $model) {
            $key = $model->getTable() . '.organization_id';
            unset($model->$key);

            $slug = Str::slug($model->name);

            $repeatedSlug = $model->newQueryWithoutScopes()->where('slug', $slug)->get();

            if (filled($repeatedSlug))  $slug = $slug . '-' . ($repeatedSlug->count() + rand(1, 50));

            $model->slug = $slug;
        });
    }
}