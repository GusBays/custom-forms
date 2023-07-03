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

    private int $id;
    private int $organization_id;
    /** @var FormUserUpdateData[] */
    private ?array $formUsers = null;
    /** @var FormFieldUpdateData[] */
    private ?array $formFields = null;
    private ?string $slug = null;
    private ?string $created_at = null;
    private ?string $updated_at = null;

    public function __construct(
        int $id,
        int $organization_id,
        string $name = null,
        string $available_until = null,
        int $fill_limit = null,
        bool $should_notify_each_fill = true,
        bool $active = true,
        string $slug = null,
        array $formUsers = [],
        array $formFields = [],
        string $created_at = null,
        string $updated_at = null
    )
    {
        $this->id = $id;
        $this->organization_id = $organization_id;
        $this->slug = $slug;
        $this->formUsers = $formUsers;
        $this->formFields = $formFields;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        parent::__construct(
            $name,
            $available_until,
            $fill_limit,
            $should_notify_each_fill,
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