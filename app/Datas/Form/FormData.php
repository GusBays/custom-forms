<?php

namespace App\Datas\Form;

use App\Datas\FormField\FormFieldData;
use App\Datas\FormUser\FormUserData;
use Illuminate\Contracts\Support\Arrayable;

abstract class FormData implements Arrayable
{
    private string $name;
    private ?string $available_until = null;
    private ?int $fill_limit = null;
    private bool $should_notify_each_fill = true;
    private bool $active = true;
    /** @var FormUserData[] */
    private ?array $form_users = null;
    /** @var FormFieldData[] */
    private ?array $form_fields = [];

    public function __construct(
        string $name,
        string $available_until = null,
        int $fill_limit = null,
        bool $should_notify_each_fill = true,
        bool $active = true,
        array $form_users = [],
        array $form_fields = []
    )
    {
        $this->name = $name;
        $this->available_until = $available_until;
        $this->fill_limit = $fill_limit;
        $this->should_notify_each_fill = $should_notify_each_fill;
        $this->active = $active;
        $this->form_users = $form_users;
        $this->form_fields = $form_fields;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAvailableUntil(): ?string
    {
        return $this->available_until;
    }

    public function getFillLimit(): ?int
    {
        return $this->fill_limit;
    }

    public function getShouldNotifyEachFill(): bool
    {
        return $this->should_notify_each_fill;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * @return FormUserData[]
     */
    public function getFormUsers(): ?array
    {
        return $this->form_users;
    }

    /**
     * @return FormFieldData[]
     */
    public function getFormFields(): ?array
    {
        return $this->form_fields;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'available_until' => $this->getAvailableUntil(),
            'fill_limit' => $this->getFillLimit(),
            'should_notify_each_fill' => $this->getShouldNotifyEachFill(),
            'active' => $this->getActive(),
        ];
    }
}