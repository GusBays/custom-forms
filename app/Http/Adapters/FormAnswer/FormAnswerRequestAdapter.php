<?php

namespace App\Http\Adapters\FormAnswer;

use App\Datas\FormAnswer\FormAnswerData;
use Illuminate\Http\Request;

class FormAnswerRequestAdapter extends FormAnswerData
{
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            $request->input('form_id'),
            $request->input('filler_id'),
            $request->input('answers'),
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