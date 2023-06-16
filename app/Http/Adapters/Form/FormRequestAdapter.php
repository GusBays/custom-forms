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
            $request->input('name'),
            $request->input('available_until'),
            $request->input('fill_limit'),
            $request->input('should_notify_each_fill'),
            $request->input('active'),
            filled($request->form_users) ? FormUserRequestAdapter::createFromFormRequest($request->form_users) : [],
            filled($request->form_fields) ? FormFieldRequestAdapter::createFromFormRequest($request->form_fields) : []
        );
    }
}