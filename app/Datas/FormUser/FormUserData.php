<?php

namespace App\Datas\FormUser;

use Illuminate\Contracts\Support\Arrayable;

abstract class FormUserData implements Arrayable
{
    private ?int $form_id = null;
    private ?int $user_id = null;
    private ?string $type = null;

    public function __construct(
        int $form_id = null,
        int $user_id = null,
        string $type = null
    )
    {
        $this->form_id = $form_id;
        $this->user_id = $user_id;
        $this->type = $type;
    }

    public function getFormId(): ?int
    {
        return $this->form_id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setFormId(int $formId): self
    {
        $this->form_id = $formId;

        return $this;
    }

    public function setUserId(int $userId): self
    {
        $this->user_id = $userId;

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