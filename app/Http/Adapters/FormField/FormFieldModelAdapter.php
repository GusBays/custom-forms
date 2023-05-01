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
            $formField->id,
            $formField->getAttribute('organization_id') ?? $formField->getAttribute('form_fields.organization_id'),
            $formField->form_id,
            $formField->name,
            $formField->description,
            $formField->required,
            $formField->type,
            $formField->content,
            $formField->created_at,
            $formField->updated_at
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