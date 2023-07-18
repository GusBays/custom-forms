<?php

namespace App\Datas\User;

use App\Traits\GetTimestamps;
use App\Traits\SetModifiedFields;

abstract class UserUpdateData extends UserData
{
    use SetModifiedFields;
    use GetTimestamps;

    public function __construct(
        private int $id,
        private ?int $organizationId = null,
        private ?string $name = null,
        private ?string $firstName = null,
        private ?string $lastName = null,
        private ?string $email = null,
        private ?string $password = null,
        private ?string $type = null,
        private ?string $token = null,
        private ?string $createdAt = null,
        private ?string $updatedAt = null
    )
    {
        parent::__construct(
            $organizationId,
            $name,
            $firstName,
            $lastName,
            $email,
            $password,
            $type,
            $token
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
        $array['created_at'] = $this->getCreatedAt();
        $array['updated_at'] = $this->getUpdatedAt();

        return $array;
    }
}