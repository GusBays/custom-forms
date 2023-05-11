<?php

namespace App\Interpreters\Organization;

use App\Filters\Organization\OrganizationFilter;
use App\Interpreters\DbInterpreter;
use Illuminate\Database\Eloquent\Builder;

class OrganizationIdInterpreter extends DbInterpreter
{
    private OrganizationFilter $filter;

    public function __construct(
        OrganizationFilter $filter
    )
    {
        $this->filter = $filter;
    }

    public function interpret(): Builder
    {
        $id = $this->filter->getId();

        if (blank($id)) return $this->query;

        return $this->query->where('id', $id);
    }
}