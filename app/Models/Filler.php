<?php

namespace App\Models;

use App\Scopes\OrganizationScope;
use App\Traits\InsertOrganizationId;
use App\Traits\MountName;
use Illuminate\Notifications\Notifiable;

class Filler extends BaseModel
{
    use Notifiable;
    use InsertOrganizationId;
    use MountName;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
    ];

    protected array $filters = [
        'first_name',
        'email'
    ];

    protected array $search = [
        'name',
        'email',
    ];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OrganizationScope);
    }
}