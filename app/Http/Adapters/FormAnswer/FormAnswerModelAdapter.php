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
            id: $formAnswer->id,
            organizationId: $formAnswer->organization_id,
            formId: $formAnswer->form_id,
            fillerId:$formAnswer->filler_id,
            answers: $formAnswer->answers,
            createdAt: $formAnswer->created_at,
            updatedAt: $formAnswer->updated_at,
            filler: new FillerModelAdapter($formAnswer->filler)
        );
    }
}