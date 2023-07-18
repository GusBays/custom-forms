<?php

namespace App\Datas\Organization;

use App\Traits\GetTimestamps;

abstract class OrganizationUpdateData extends OrganizationData
{
    use GetTimestamps;

    public function __construct(
        private int $id,
        private ?string $name = null,
        private ?string $slug = null,
        private ?int $formsCount = null,
        private ?int $usersCount = null,
        private ?string $createdAt = null,
        private ?string $updatedAt = null,
        /** @var UserData[] */
        private ?array $users = []
    )
    {
        parent::__construct(
            $name,
            $formsCount,
            $usersCount,
            $users
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function toArray(): array
    {
        $array = parent::toArray();
        $array['id'] = $this->getId();
        $array['slug'] = $this->getSlug();
        $array['created_at'] = $this->getCreatedAt();
        $array['updated_at'] = $this->getUpdatedAt();

        return $array;
    }
}