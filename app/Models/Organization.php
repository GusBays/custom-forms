<?php

namespace App\Models;

use App\Traits\CreateSlug;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends BaseModel
{
    use CreateSlug;

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

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}