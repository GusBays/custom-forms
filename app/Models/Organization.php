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

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}