<?php

namespace App\Repositories;

use App\Datas\Organization\OrganizationData;
use App\Datas\Organization\OrganizationUpdateData;
use App\Filters\Organization\OrganizationFilter;
use App\Http\Adapters\Organization\OrganizationModelAdapter;
use App\Interpreters\Organization\OrganizationIdInterpreter;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Builder;

class OrganizationRepository
{
    protected Organization $model;
    protected Builder $query;

    public function __construct(
        Organization $model
    )
    {
        $this->model = $model;
        $this->query = $model->query();
    }

    public function create(OrganizationData $data): OrganizationUpdateData
    {
        $query = $this->model->query()->withoutGlobalScopes();

        $organization = $query->create($data->toArray());

        return new OrganizationModelAdapter($organization);
    }

    public function getOne(OrganizationFilter $filter): OrganizationUpdateData
    {
        $organization = $this->getOrganizationQuery($filter)->firstOrFail();

        return new OrganizationModelAdapter($organization);
    }

    private function getOrganizationQuery(OrganizationFilter $filter): Builder
    {
        $interpreters = [
            new OrganizationIdInterpreter($filter)
        ];

        foreach ($interpreters as $interpreter) {
            $interpreter->setQuery($this->query)->interpret();
        }

        return $this->query;
    }
}