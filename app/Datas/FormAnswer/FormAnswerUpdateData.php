<?php

namespace App\Datas\FormAnswer;

use App\Datas\Filler\FillerUpdateData;
use App\Traits\GetOrganizationId;
use App\Traits\GetTimestamps;

abstract class FormAnswerUpdateData extends FormAnswerData
{
    use GetOrganizationId;
    use GetTimestamps;

    private ?int $id = null;
    private ?int $organization_id = null;
    private ?string $created_at = null;
    private ?string $updated_at = null;
    private ?FillerUpdateData $filler = null;

    public function __construct(
        int $id = null,
        int $organization_id = null,
        int $form_id,
        int $filler_id,
        array $answers = null,
        string $created_at = null,
        string $updated_at = null,
        FillerUpdateData $filler = null
    )
    {
        $this->id = $id;
        $this->organization_id = $organization_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->filler = $filler;
        parent::__construct(
            $form_id,
            $filler_id,
            $answers,
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFiller(): ?FillerUpdateData
    {
        return $this->filler;
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