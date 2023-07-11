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
            $request->route('id') ?? $request->input('id'),
            $request->input('organization_id', config('organization_id')),
            $request->input('form_id'),
            $request->input('name'),
            $request->input('description'),
            $request->input('required', true),
            $request->input('type'),
            $request->input('content'),
            $request->input('created_at'),
            $request->input('updated_at')
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