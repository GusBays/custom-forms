<?php

namespace App\Datas\FormField;

use Illuminate\Contracts\Support\Arrayable;

abstract class FormFieldData implements Arrayable
{
    public function __construct(
        private ?int $formId = null,
        private ?string $name = null,
        private ?string $description = null,
        private bool $required = true,
        private ?string $type = null,
        private ?array $content = null
    )
    {}

    public function getFormId(): ?int
    {
        return $this->formId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getRequired(): ?bool
    {
        return $this->required;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getContent(): ?array
    {
        return $this->content;
    }

    public function setFormId(int $formId): self
    {
        $this->formId = $formId;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'form_id' => $this->getFormId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'required' => $this->getRequired(),
            'type' => $this->getType(),
            'content' => $this->getContent()
        ];
    }
}