<?php

namespace App\Models;

use App\Scopes\OrganizationScope;
use App\Traits\CreateSlug;
use App\Traits\InsertOrganizationId;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Form extends BaseModel
{
    use InsertOrganizationId;
    use CreateSlug;

    protected $fillable = [
        'name',
        'available_until',
        'fill_limit',
        'should_notify_each_fill',
        'active',
    ];

    protected array $filters = [
        'available_until',
        'active',
    ];

    protected array $search = [
        'name',
        'slug',
    ];

    protected $casts = [
        'should_notify_each_fill' => 'bool',
        'active' => 'bool'
    ];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OrganizationScope);

        $incrementFormsCount = fn (Form $model) => Organization::query()
            ->where('id', $model->getAttribute('forms.organization_id'))
            ->increment('forms_count');
        static::created($incrementFormsCount);
    }

    public function formUsers(): HasMany
    {
        return $this->hasMany(FormUser::class);
    }

    public function formFields(): HasMany
    {
        return $this->hasMany(FormField::class);
    }
}