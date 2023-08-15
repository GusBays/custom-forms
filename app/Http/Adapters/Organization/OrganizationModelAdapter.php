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
            id: $organization->id,
            name: $organization->name,
            slug: $organization->slug,
            formsCount: $organization->forms_count,
            usersCount: $organization->users_count,
            createdAt: $organization->created_at,
            updatedAt:$organization->updated_at,
            users: UserModelAdapter::collection($organization->users)
        );
    }
}