<?php

namespace App\Http\Adapters\Form;

use App\Datas\Form\FormUpdateData;
use App\Http\Adapters\FormField\FormFieldRequestAdapter;
use App\Http\Adapters\FormField\FormFieldUpdateRequestAdapter;
use App\Http\Adapters\FormUser\FormUserUpdateRequestAdapter;
use Illuminate\Http\Request;

class FormUpdateRequestAdapter extends FormUpdateData
{
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            id: $request->route('id'),
            organizationId: $request->input('organization_id', config('organization_id')),
            name: $request->input('name'),
            availableUntil: $request->input('available_until'),
            fillLimit: $request->input('fill_limit'),
            shouldNotifyEachFill: $request->input('should_notify_each_fill', true),
            active: $request->input('active', true),
            slug: $request->input('slug'),
            formUsers: $request->has('form_users') ? FormUserUpdateRequestAdapter::createFromFormUpdateRequest($request->form_users) : [],
            formFields: $request->has('form_fields') ? FormFieldUpdateRequestAdapter::createFromFormUpdateRequest($request->form_fields) : [],
            createdAt: $request->input('created_at'),
            updatedAt: $request->input('updated_at')
        );

        foreach ($request->all() as $key => $value) {
            $this->setField($key, $value);
        }
    }
}