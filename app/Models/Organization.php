<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

        static::creating(function (Model $model) {
            $key = $model->getTable() . '.organization_id';
            unset($model->$key);

            $slug = Str::slug($model->name);
            $originalSlug = $slug;

            $query = $model->newQueryWithoutScopes()->where('slug', $slug)->get();
            $toSlug = fn (Organization $organization) => ['slug' => $organization->slug];

            $i = 1;

            while (in_array($slug, $query->mapWithKeys($toSlug)->all())) {
                $slug = $originalSlug . '-' . $i;
                $i++;
                $query = $model->newQueryWithoutScopes()->where('slug', $slug)->get();
            }

            $model->slug = $slug;
        });
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}