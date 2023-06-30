<?php

namespace App\Http\Adapters\FormAnswer;

use App\Datas\FormAnswer\FormAnswerUpdateData;
use App\Http\Adapters\Filler\FillerModelAdapter;
use App\Models\FormAnswer;

class FormAnswerModelAdapter extends FormAnswerUpdateData
{
    public function __construct(
        FormAnswer $formAnswer
    )
    {
        parent::__construct(
            $formAnswer->id,
            $formAnswer->organization_id,
            $formAnswer->form_id,
            $formAnswer->filler_id,
            $formAnswer->answers,
            $formAnswer->created_at,
            $formAnswer->updated_at,
            new FillerModelAdapter($formAnswer->filler)
        );
    }
}