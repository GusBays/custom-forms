<?php

namespace App\Datas\FormUser;

use App\Traits\GetOrganizationId;
use App\Traits\GetTimestamps;
use App\Traits\SetModifiedFields;

class FormUserUpdateData extends FormUserData
{
    use GetOrganizationId;
    use GetTimestamps;
    use SetModifiedFields;

    private int $id;
    private int $organization_id;
    private ?string $created_at = null;
    private ?string $updated_at = null;

    public function __construct(
        int $id,
        int $organization_id,
        int $form_id = null,
        int $user_id = null,
        string $type = null,
        string $created_at = null,
        string $updated_at = null
    )
    {
        $this->id = $id;
        $this->organization_id = $organization_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
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

    public function toArray(): array
    {
        $array = parent::toArray();
        $array['id'] = $this->getId();
        $array['created_at'] = $this->getCreatedAt();
        $array['updated_at'] = $this->getUpdatedAt();

        return $array;
    }
}