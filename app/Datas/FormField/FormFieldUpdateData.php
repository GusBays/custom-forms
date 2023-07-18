<?php

namespace App\Datas\FormField;

use App\Traits\GetOrganizationId;
use App\Traits\GetTimestamps;
use App\Traits\SetModifiedFields;

abstract class FormFieldUpdateData extends FormFieldData
{
    use GetOrganizationId;
    use GetTimestamps;
    use SetModifiedFields;

    public function __construct(
        private int $id,
        private int $organizationId,
        private ?int $formId = null,
        private ?string $name = null,
        private ?string $description = null,
        private bool $required = true,
        private ?string $type = null,
        private ?array $content = null,
        private ?string $createdAt = null,
        private ?string $updatedAt = null
    )
    {
        parent::__construct(
            $formId,
            $name,
            $description,
            $required,
            $type,
            $content
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function toArray(): array
    {
        $array = parent::toArray();
        $array['id'] = $this->getId();
        $array['organization_id'] = $this->getOrganizationId();
        $array['created_at'] = $this->getCreatedAt();
        $array['updated_at'] = $this->getUpdatedAt(); 

        return $array;
    }
}