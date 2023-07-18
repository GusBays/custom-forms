<?php

namespace App\Http\Adapters\User;

use App\Datas\User\UserData;
use Illuminate\Http\Request;

class UserRequestAdapter extends UserData
{
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            organizationId: $request->input('organization_id', config('organization_id')),
            name: $request->input('name'),
            firstName: $request->input('first_name'),
            lastName: $request->input('last_name'),
            email: $request->input('email'),
            password: $request->input('password'),
            type: $request->input('type', 'employee'),
        );
    }

    public static function fromOrganizationRequest(Request $request): array
    {
        $request->merge(['type' => 'owner']);

        return [new self($request)];
    }
}