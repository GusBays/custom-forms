<?php

namespace App\Http\Adapters\FormField;

use App\Datas\FormField\FormFieldData;
use Illuminate\Http\Request;

class FormFieldRequestAdapter extends FormFieldData
{
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            formId: $request->input('form_id'),
            name: $request->input('name'),
            description: $request->input('description'),
            required: $request->input('required', true),
            type: $request->input('type'),
            content: $request->input('content', [])
        );
    }

    public static function createFromFormRequest(array $formFields): array
    {
        $toRequest = fn (array $formField) => new Request($formField);
        return collect($formFields)
            ->map($toRequest)
            ->mapInto(self::class)
            ->all();
    }
}