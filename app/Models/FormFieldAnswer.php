<?php

namespace App\Models;

use App\Scopes\OrganizationScope;
use App\Traits\InsertOrganizationId;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FormFieldAnswer extends BaseModel
{
    use InsertOrganizationId;

    protected $fillable = [
        'form_id',
        'field_id',
        'filler_id',
        'answer',
    ];

    protected array $filter = [
        'form_id',
        'field_id',
        'filler_id'
    ];

    protected array $search = [

    ];

    protected $casts = [
        'answer' => 'array'
    ];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OrganizationScope);
    }

    public function form(): HasOne
    {
        return $this->hasOne(Form::class);
    }

    public function formField(): HasOne
    {
        return $this->hasOne(FormField::class);
    }

    public function filled(): HasOne
    {
        return $this->hasOne(Filler::class);
    }
}