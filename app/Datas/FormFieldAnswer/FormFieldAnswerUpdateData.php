<?php

namespace App\Datas\FormFieldAnswer;

use App\Datas\Form\FormUpdateData;
use App\Traits\GetOrganizationId;
use App\Traits\GetTimestamps;

abstract class FormFieldAnswerUpdateData extends FormFieldAnswerData
{
    use GetOrganizationId;
    use GetTimestamps;

    private ?int $id = null;
    private ?int $organization_id = null;
    private ?string $created_at = null;
    private ?string $updated_at = null;

    public function __construct(
        int $id = null,
        int $organization_id = null,
        int $form_id,
        int $field_id,
        int $filler_id,
        array $answer = null,
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
            $field_id,
            $filler_id,
            $answer
        );
    }

    public function getId(): ?int
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