<?php

namespace App\Datas\Organization;

use App\Traits\GetTimestamps;

class OrganizationUpdateData extends OrganizationData
{
    use GetTimestamps;

    private int $id;
    private ?string $slug = null;
    private ?string $created_at = null;
    private ?string $updated_at = null;

    public function __construct(
        int $id,
        string $name = null,
        string $slug = null,
        int $forms_count = null,
        int $users_count = null,
        string $created_at = null,
        string $updated_at = null
    )
    {
        $this->id = $id;
        $this->slug = $slug;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        parent::__construct(
            $name,
            $forms_count,
            $users_count,
            null
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