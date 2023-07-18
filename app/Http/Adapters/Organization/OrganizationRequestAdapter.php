<?php

namespace App\Http\Adapters\Organization;

use App\Datas\Organization\OrganizationData;
use App\Http\Adapters\User\UserRequestAdapter;
use Illuminate\Http\Request;

class OrganizationRequestAdapter extends OrganizationData
{
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            name: $request->input('name'),
            usersCount: $request->input('users_count'),
            formsCount: $request->input('forms_count'),
            users: UserRequestAdapter::fromOrganizationRequest($request)
        );
    }
}