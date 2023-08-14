<?php

namespace App\Http\Adapters\Form;

use App\Datas\Form\FormData;
use App\Http\Adapters\FormField\FormFieldRequestAdapter;
use App\Http\Adapters\FormUser\FormUserRequestAdapter;
use Illuminate\Http\Request;

class FormRequestAdapter extends FormData
{
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            name: $request->input('name'),
            availableUntil: $request->input('available_until'),
            fillLimit: $request->input('fill_limit'),
            shouldNotifyEachFill: $request->input('should_notify_each_fill', false),
            active: $request->input('active', true),
            formUsers: filled($request->form_users) ? FormUserRequestAdapter::createFromFormRequest($request->form_users) : [],
            formFields: filled($request->form_fields) ? FormFieldRequestAdapter::createFromFormRequest($request->form_fields) : []
        );
    }
}