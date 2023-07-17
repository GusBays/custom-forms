<?php

namespace App\Models;

use App\Traits\CreateSlug;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends BaseModel
{
    use CreateSlug;

    protected $fillable = [
        'name',
    ];

    protected array $search = [
        'name',
        'slug'
    ];

    /** @var array */
    protected $attributes = [
        'forms_count' => 0,
        'users_count' => 0
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}