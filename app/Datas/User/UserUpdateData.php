<?php

namespace App\Datas\User;

use App\Traits\SetModifiedFields;

abstract class UserUpdateData extends UserData
{
    use SetModifiedFields;

    private int $id;
    private ?string $created_at = null;
    private ?string $updated_at = null;

    public function __construct(
        int $id,
        int $organization_id = null,
        string $name = null,
        string $first_name = null,
        string $last_name = null,
        string $email = null,
        string $password = null,
        string $type = null,
        string $token = null,
        string $created_at = null,
        string $updated_at = null
    )
    {
        $this->id = $id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        parent::__construct(
            $organization_id,
            $name,
            $first_name,
            $last_name,
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

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
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