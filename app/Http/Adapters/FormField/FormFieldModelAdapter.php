<?php

namespace App\Http\Adapters\FormField;

use App\Datas\FormField\FormFieldUpdateData;
use App\Models\FormField;
use Illuminate\Database\Eloquent\Collection;

class FormFieldModelAdapter extends FormFieldUpdateData
{
    public function __construct(
        FormField $formField
    )
    {
        parent::__construct(
            id: $formField->id,
            organizationId: $formField->getAttribute('organization_id') ?? $formField->getAttribute('form_fields.organization_id'),
            formId: $formField->form_id,
            name: $formField->name,
            description: $formField->description,
            required: $formField->required,
            type: $formField->type,
            content: $formField->content,
            createdAt: $formField->created_at,
            updatedAt: $formField->updated_at
        );
    }

    public static function createFromFormModel(Collection $formFields): array
    {
        return $formFields->mapInto(self::class)->all();
    }

    public static function collection(array $formFields): array
    {
        return collect($formFields)->mapInto(self::class)->all();
    }
}