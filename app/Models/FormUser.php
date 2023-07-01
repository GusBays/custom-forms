<?php

namespace App\Models;

use App\Scopes\OrganizationScope;
use App\Traits\InsertOrganizationId;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FormUser extends BaseModel
{
    use InsertOrganizationId;

    protected $fillable = [
        'form_id',
        'user_id',
        'type'
    ];

    protected array $filter = [
        'form_id',
        'user_id',
    ];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OrganizationScope);
    }

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}