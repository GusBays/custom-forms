<?php

namespace App\Http\Adapters\FormAnswer;

use App\Datas\FormAnswer\FormAnswerUpdateData;
use Illuminate\Http\Request;

class FormAnswerUpdateRequestAdapter extends FormAnswerUpdateData
{
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            id: $request->route('id') ?? $request->input('id'),
            organizationId: config('organization_id'),
            formId: $request->input('form_id'),
            fillerId: $request->input('filler_id'),
            answers: $request->input('answers'),
            createdAt: $request->input('created_at'),
            updatedAt: $request->input('updated_at'),
            filler: null
        );
    }
}