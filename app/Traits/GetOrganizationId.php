<?php

namespace App\Traits;

trait GetOrganizationId
{
    public function getOrganizationId(): ?int
    {
        return $this->organization_id;
    }
}