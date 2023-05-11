<?php

namespace App\Filters\Organization;

use App\Helpers\Utils;

class OrganizationIdFilter extends OrganizationFilter
{
    public function __construct()
    {
        parent::__construct(
            Utils::getOrganizationIdFromAuth()
        );
    }
}