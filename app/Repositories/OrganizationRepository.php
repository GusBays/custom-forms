<?php

namespace App\Repositories;

use App\Models\Organization;

class OrganizationRepository extends BaseRepository
{
    /** @var Organization */
    protected $model;

    public function __construct(
        Organization $model
    )
    {
        parent::__construct($model);
    }

    public function create(array $data): Organization
    {
        $query = $this->model->query()->withoutGlobalScopes();

        return $query->forceCreate($data);
    }
}