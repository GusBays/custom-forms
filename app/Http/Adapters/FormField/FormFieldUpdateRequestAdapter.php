<?php

namespace App\Http\Adapters\FormField;

use App\Datas\FormField\FormFieldUpdateData;
use Illuminate\Http\Request;

class FormFieldUpdateRequestAdapter extends FormFieldUpdateData
{
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            id: $request->route('id') ?? $request->input('id'),
            organizationId: $request->input('organization_id', config('organization_id')),
            formId: $request->input('form_id'),
            name: $request->input('name'),
            description: $request->input('description'),
            required: $request->input('required', true),
            type: $request->input('type'),
            content: $request->input('content'),
            createdAt: $request->input('created_at'),
            updatedAt: $request->input('updated_at')
        );

        foreach ($request->all() as $key => $value) {
            $this->setField($key, $value);
        }
    }

    public static function createFromFormUpdateRequest(array $fields): array
    {
        $toRequest = fn (array $field) => new Request($field);
        return collect($fields)
            ->map($toRequest)
            ->mapInto(self::class)
            ->all();
    }
}