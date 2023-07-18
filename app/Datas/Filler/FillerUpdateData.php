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

    public function __construct(
        private int $id,
        private int $organizationId,
        private ?string $name = null,
        private ?string $firstName = null,
        private ?string $lastName = null,
        private ?string $email = null,
        private ?string $createdAt = null,
        private ?string $updatedAt = null,
    )
    {
        parent::__construct(
            $firstName,
            $lastName,
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