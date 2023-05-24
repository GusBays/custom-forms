<?php

namespace App\Http\Adapters\Organization;

use App\Datas\Organization\OrganizationUpdateData;
use App\Http\Adapters\User\UserModelAdapter;
use App\Models\Organization;

class OrganizationModelAdapter extends OrganizationUpdateData
{
    public function __construct(
        Organization $organization
    )
    {
        parent::__construct(
            $organization->id,
            $organization->name,
            $organization->slug,
            $organization->forms_count,
            $organization->users_count,
            $organization->created_at,
            $organization->updated_at,
            UserModelAdapter::fromOrganizationModel($organization->users)
        );
    }
}