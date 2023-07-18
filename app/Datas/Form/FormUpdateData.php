<?php

namespace App\Datas\Form;

use App\Datas\FOrmUser\FormUserUpdateData;
use App\Traits\GetOrganizationId;
use App\Traits\GetTimestamps;
use App\Traits\SetModifiedFields;

abstract class FormUpdateData extends FormData
{
    use GetOrganizationId;
    use GetTimestamps;
    use SetModifiedFields;

    public function __construct(
        private int $id,
        private int $organizationId,
        private ?string $name = null,
        private ?string $availableUntil = null,
        private ?int $fillLimit = null,
        private bool $shouldNotifyEachFill = true,
        private bool $active = true,
        private ?string $slug = null,
        /** @var FormUserUpdateData[] */
        private array $formUsers = [],
        /** @var FormFieldUpdateData[] */
        private array $formFields = [],
        private ?string $createdAt = null,
        private ?string $updatedAt = null
    )
    {
        parent::__construct(
            $name,
            $availableUntil,
            $fillLimit,
            $shouldNotifyEachFill,
            $active
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

    /**
     * @return FormUserUpdateData[]
     */
    public function getFormUsers(): ?array
    {
        return $this->formUsers;
    }

    /**
     * @return FormFieldUpdateData[]
     */
    public function getFormFields(): ?array
    {
        return $this->formFields;
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