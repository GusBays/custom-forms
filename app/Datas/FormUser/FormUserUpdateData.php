<?php

namespace App\Datas\FormUser;

use App\Datas\User\UserUpdateData;
use App\Traits\GetOrganizationId;
use App\Traits\GetTimestamps;
use App\Traits\SetModifiedFields;

abstract class FormUserUpdateData extends FormUserData
{
    use GetOrganizationId;
    use GetTimestamps;
    use SetModifiedFields;

    public function __construct(
        private int $id,
        private int $organizationId,
        private ?int $formId = null,
        private ?int $userId = null,
        private ?string $type = null,
        private ?string $createdAt = null,
        private ?string $updatedAt = null,
        private ?UserUpdateData $user = null
    )
    {
        parent::__construct(
            $formId,
            $userId,
            $type
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): ?UserUpdateData
    {
        return $this->user;
    }

    public function toArray(): array
    {
        $array = parent::toArray();
        $array['id'] = $this->getId();
        $array['created_at'] = $this->getCreatedAt();
        $array['updated_at'] = $this->getUpdatedAt();

        return $array;
    }
}