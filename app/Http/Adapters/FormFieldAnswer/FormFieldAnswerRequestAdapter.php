<?php

namespace App\Http\Adapters\FormFieldAnswer;

use App\Datas\FormFieldAnswer\FormFieldAnswerData;
use Illuminate\Http\Request;

class FormFieldAnswerRequestAdapter extends FormFieldAnswerData
{
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            $request->input('form_id'),
            $request->input('field_id'),
            $request->input('filler_id'),
            $request->input('answer')
        );
    }

    public static function createFromRequestArray(array $answers): array
    {
        $toRequest = fn (array $answer) => new Request($answer);
        return collect($answers)
            ->map($toRequest)
            ->mapInto(self::class)
            ->all();
    }
}