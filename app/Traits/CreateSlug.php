<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait CreateSlug
{
    protected static function bootCreateSlug()
    {
        /** @var Model $this */
        static::creating(function (Model $model) {
            $slug = Str::slug($model->name);
            $originalSlug = $slug;

            $repeatedSlugs = $model->query()->where('slug', $slug)->get();
            $toSlug = fn (Model $model) => ['slug' => $model->slug];

            $i = 1;

            while (in_array($slug, $repeatedSlugs->mapWithKeys($toSlug)->all())) {
                $slug = $originalSlug . '-' . $i;
                $i++;
                $repeatedSlugs = $model->query()->where('slug', $slug)->get();
            }

            $model->slug = $slug;
        });
    }
}