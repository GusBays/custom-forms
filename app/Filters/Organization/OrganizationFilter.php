<?php

namespace App\Filters\Organization;

use App\Contracts\Filter;

abstract class OrganizationFilter implements Filter
{
    private ?int $id = null;

    public function __construct(
        int $id = null
    )
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}