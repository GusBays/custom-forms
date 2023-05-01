<?php

namespace App\Models;

use App\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormField extends BaseModel
{
    protected $fillable = [
        'form_id',
        'name',
        'description',
        'required',
        'type',
        'content'
    ];

    protected array $filters = [
        'name',
        'required',
        'type',
        'form_id'
    ];

    protected array $search = [
        'name'
    ];

    protected array $sorts = [
        'id',
        'form_id'
    ];

    protected $casts = [
        'required' => 'bool',
        'content' => 'array'
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