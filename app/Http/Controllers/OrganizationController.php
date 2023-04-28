<?php

namespace App\Http\Controllers;

use App\Services\OrganizationService;

class OrganizationController extends BaseController
{
    /** @var OrganizationService */
    protected $service;

    public function __construct(
        OrganizationService $service
    )
    {
        $this->service = $service;
    }
}