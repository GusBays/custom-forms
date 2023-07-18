<?php

namespace App\Datas\FormAnswer;

use App\Datas\Filler\FillerUpdateData;
use App\Traits\GetOrganizationId;
use App\Traits\GetTimestamps;

abstract class FormAnswerUpdateData extends FormAnswerData
{
    use GetOrganizationId;
    use GetTimestamps;

    public function __construct(
        private ?int $id = null,
        private ?int $organizationId = null,
        private int $formId,
        private int $fillerId,
        private ?array $answers = null,
        private ?string $createdAt = null,
        private ?string $updatedAt = null,
        private ?FillerUpdateData $filler = null
    )
    {
        parent::__construct(
            $formId,
            $fillerId,
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