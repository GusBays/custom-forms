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
            $request->input('form_id'),
            $request->input('name'),
            $request->input('description'),
            $request->input('required', true),
            $request->input('type'),
            $request->input('content', [])
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