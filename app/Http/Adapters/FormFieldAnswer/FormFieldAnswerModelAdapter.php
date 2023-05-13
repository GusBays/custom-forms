<?php

namespace App\Http\Adapters\FormFieldAnswer;

use App\Datas\FormFieldAnswer\FormFieldAnswerUpdateData;
use App\Models\FormFieldAnswer;

class FormFieldAnswerModelAdapter extends FormFieldAnswerUpdateData
{
    public function __construct(
        FormFieldAnswer $formFieldAnswer
    )
    {
        parent::__construct(
            $formFieldAnswer->id,
            $formFieldAnswer->organization_id,
            $formFieldAnswer->form_id,
            $formFieldAnswer->field_id,
            $formFieldAnswer->filler_id,
            $formFieldAnswer->answer,
            $formFieldAnswer->created_at,
            $formFieldAnswer->updated_at
        );
    }
}