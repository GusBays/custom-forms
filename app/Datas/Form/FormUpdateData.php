<?php

namespace App\Datas\Form;

use App\Traits\GetOrganizationId;
use App\Traits\GetTimestamps;
use App\Traits\SetModifiedFields;

class FormUpdateData extends FormData
{
    use GetOrganizationId;
    use GetTimestamps;
    use SetModifiedFields;

    private int $id;
    private int $organization_id;
    private ?string $slug = null;
    private ?string $created_at = null;
    private ?string $updated_at = null;

    public function __construct(
        int $id,
        int $organization_id,
        string $name,
        string $available_until = null,
        int $fill_limit = null,
        bool $should_notify_each_fill = true,
        bool $active = true,
        string $slug = null,
        array $form_users = [],
        array $form_fields = [],
        string $created_at = null,
        string $updated_at = null
    )
    {
        $this->id = $id;
        $this->organization_id = $organization_id;
        $this->slug = $slug;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        parent::__construct(
            $name,
            $available_until,
            $fill_limit,
            $should_notify_each_fill,
            $active,
            $form_users,
            $form_fields
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
        $array['organization_id'] = $this->getOrganizationId();
        $array['slug'] = $this->getSlug();
        $array['created_at'] = $this->getCreatedAt();
        $array['updated_at'] = $this->getUpdatedAt();

        return $array;
    }
}