<?php

namespace App\Http\Adapters\Form;

use App\Datas\Form\FormUpdateData;
use App\Http\Adapters\FormField\FormFieldRequestAdapter;
use App\Http\Adapters\FormUser\FormUserRequestAdapter;
use Illuminate\Http\Request;

class FormUpdateRequestAdapter extends FormUpdateData
{
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            $request->route('id'),
            $request->input('organization_id', config('organization_id')),
            $request->input('name'),
            $request->input('available_until'),
            $request->input('fill_limit'),
            $request->input('should_notify_each_fill', true),
            $request->input('active', true),
            $request->input('slug'),
            FormUserRequestAdapter::createFromFormRequest($request),
            FormFieldRequestAdapter::createFromFormRequest($request),
            $request->input('created_at'),
            $request->input('updated_at')
        );

        foreach ($request->all() as $key => $value) {
            $this->setField($key, $value);
        }
    }
}