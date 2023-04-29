<?php

namespace App\Repositories;

use App\Datas\Organization\OrganizationData;
use App\Datas\Organization\OrganizationUpdateData;
use App\Http\Adapters\Organization\OrganizationModelAdapter;
use App\Models\Organization;

class OrganizationRepository
{
    protected Organization $model;

    public function __construct(
        Organization $model
    )
    {
        $this->model = $model;
    }

    public function create(OrganizationData $data): OrganizationUpdateData
    {
        $query = $this->model->query()->withoutGlobalScopes();

        $organization = $query->create($data->toArray());

        return new OrganizationModelAdapter($organization);
    }
}