<?php

namespace App\Datas\Filler;

use App\Traits\GetOrganizationId;
use App\Traits\GetTimestamps;
use App\Traits\SetModifiedFields;

abstract class FillerUpdateData extends FillerData
{
    use GetOrganizationId;
    use GetTimestamps;
    use SetModifiedFields;

    private int $id;
    private int $organization_id;
    private ?string $name = null;
    private ?string $created_at = null;
    private ?string $updated_at = null;

    public function __construct(
        int $id,
        int $organization_id,
        string $name = null,
        string $first_name = null,
        string $last_name = null,
        string $email = null,
        string $created_at = null,
        string $updated_at = null
    )
    {
        $this->id = $id;
        $this->organization_id = $organization_id;
        $this->name = $name;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        parent::__construct(
            $first_name,
            $last_name,
            $email
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function toArray(): array
    {
        $array = parent::toArray();
        $array['id'] = $this->getId();
        $array['name'] = $this->getName();
        $array['created_at'] = $this->getCreatedAt();
        $array['updated_at'] = $this->getUpdatedAt();

        return $array;
    }
}