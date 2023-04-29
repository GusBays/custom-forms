<?php

namespace App\Models;

use App\Scopes\OrganizationScope;
use App\Traits\InsertOrganizationId;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormUser extends BaseModel
{
    use InsertOrganizationId;

    protected array $rules = [
        'form_id' => 'required|integer|exists:forms',
        'user_id' => 'required|integer|exists:users',
        'type' => 'required|in:creator,editor,viewer',
    ];

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
}