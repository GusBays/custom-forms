<?php

namespace App\Models;

use App\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Form extends BaseModel
{
    protected array $rules = [
        'name' => 'required|max:255',
        'available_until' => 'nullable|date|date_format:Y-m-d|after_or_equal:today',
        'fill_limt' => 'nullable|integer',
        'should_notify_each_fill' => 'boolean',
        'active' => 'boolean',
    ];

    protected $fillable = [
        'name',
        'available_until',
        'fill_limit',
        'should_notify_each_fill',
        'active',
    ];

    protected array $filter = [
        'available_until',
        'active',
    ];

    protected array $search = [
        'name',
    ];

    protected $casts = [
        'should_notify_each_fill' => 'bool',
        'active' => 'bool'
    ];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OrganizationScope);

        static::creating(function (Model $model) {
            $slug = Str::slug($model->name);
            $originalSlug = $slug;

            $query = $model->query()->where('slug', $slug)->get();
            $toSlug = fn (Organization $organization) => ['slug' => $organization->slug];

            $i = 1;

            while (in_array($slug, $query->mapWithKeys($toSlug)->all())) {
                $slug = $originalSlug . '-' . $i;
                $i++;
                $query = $model->query()->where('slug', $slug)->get();
            }

            $model->slug = $slug;
        });
    }
}