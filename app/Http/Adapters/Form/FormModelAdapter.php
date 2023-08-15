<?php

namespace App\Http\Adapters\Form;

use App\Datas\Form\FormUpdateData;
use App\Http\Adapters\FormField\FormFieldModelAdapter;
use App\Http\Adapters\FormUser\FormUserModelAdapter;
use App\Models\Form;
use Illuminate\Database\Eloquent\Collection;

class FormModelAdapter extends FormUpdateData
{
    public function __construct(
        Form $form
    )
    {
        parent::__construct(
            id: $form->id,
            organizationId: $form->getAttribute('organization_id') ?? $form->getAttribute('forms.organization_id'),
            name: $form->name,
            availableUntil: $form->available_until,
            fillLimit: $form->fill_limit,
            shouldNotifyEachFill: $form->should_notify_each_fill,
            active: $form->active,
            slug: $form->slug,
            formUsers: FormUserModelAdapter::collection($form->formUsers),
            formFields: FormFieldModelAdapter::collection($form->formFields),
            createdAt: $form->created_at,
            updatedAt: $form->updated_at
        );
    }

    public static function collection(Collection | array $forms): array
    {
        return collect($forms)->mapInto(self::class)->all();
    }
}