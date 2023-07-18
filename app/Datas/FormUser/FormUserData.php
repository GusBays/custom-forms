<?php

namespace App\Datas\FormUser;

use Illuminate\Contracts\Support\Arrayable;

abstract class FormUserData implements Arrayable
{
    public function __construct(
        private ?int $formId = null,
        private ?int $userId = null,
        private ?string $type = null
    )
    {}

    public function getFormId(): ?int
    {
        return $this->formId;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setFormId(int $formId): self
    {
        $this->formId = $formId;

        return $this;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'form_id' => $this->getFormId(),
            'user_id' => $this->getUserId(),
            'type' => $this->getType(),
        ];
    }
}