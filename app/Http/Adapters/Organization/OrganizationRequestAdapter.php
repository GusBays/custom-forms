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
            $request->input('name'),
            $request->input('users_count'),
            $request->input('forms_count'),
            UserRequestAdapter::fromOrganizationRequest($request)
        );
    }
}