<?php

namespace App\Http\Adapters\User;

use App\Datas\User\UserUpdateData;
use Illuminate\Http\Request;

class UserRequestUpdateAdapter extends UserUpdateData
{
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            id: $request->route('id') ?? $request->input('id'),
            organizationId: $request->input('organization_id', config('organization_id')),
            name: $request->input('name'),
            firstName: $request->input('first_name'),
            lastName: $request->input('last_name'),
            email: $request->input('email'),
            password: $request->input('password'),
            type: $request->input('type'),
            token: $request->input('token'),
            createdAt: $request->input('created_at'),
            updatedAt: $request->input('updated_at')
        );

        foreach ($request->all() as $key => $value) {
            $this->setField($key, $value);
        }
    }
}