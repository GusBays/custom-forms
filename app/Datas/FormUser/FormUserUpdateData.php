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

    private int $id;
    private int $organization_id;
    private ?string $created_at = null;
    private ?string $updated_at = null;
    private ?UserUpdateData $user = null;

    public function __construct(
        int $id,
        int $organization_id,
        int $form_id = null,
        int $user_id = null,
        string $type = null,
        string $created_at = null,
        string $updated_at = null,
        UserUpdateData $user = null
    )
    {
        $this->id = $id;
        $this->organization_id = $organization_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->user = $user;
        parent::__construct(
            $form_id,
            $user_id,
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