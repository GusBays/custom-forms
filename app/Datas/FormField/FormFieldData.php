<?php

namespace App\Datas\FormField;

use Illuminate\Contracts\Support\Arrayable;

class FormFieldData implements Arrayable
{
    private ?int $form_id = null;
    private ?string $name = null;
    private ?string $description = null;
    private ?bool $required = true;
    private ?string $type = null;
    private ?array $content = [];

    public function __construct(
        int $form_id = null,
        string $name = null,
        string $description = null,
        bool $required = true,
        string $type = null,
        array $content = []
    )
    {
        $this->form_id = $form_id;
        $this->name = $name;
        $this->description = $description;
        $this->required = $required;
        $this->type = $type;
        $this->content = $content;
    }

    public function getFormId(): ?int
    {
        return $this->form_id;
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