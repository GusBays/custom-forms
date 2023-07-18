<?php

namespace App\Datas\Form;

use App\Datas\FormField\FormFieldData;
use App\Datas\FormUser\FormUserData;
use Illuminate\Contracts\Support\Arrayable;

abstract class FormData implements Arrayable
{
    public function __construct(
        private ?string $name = null,
        private ?string $availableUntil = null,
        private ?int $fillLimit = null,
        private bool $shouldNotifyEachFill = true,
        private bool $active = true,
        /** @var FormUserData[] */
        private array $formUsers = [],
        /** @var FormFieldData[] */
        private array $formFields = []
    )
    {}

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getAvailableUntil(): ?string
    {
        return $this->availableUntil;
    }

    public function getFillLimit(): ?int
    {
        return $this->fillLimit;
    }

    public function getShouldNotifyEachFill(): bool
    {
        return $this->shouldNotifyEachFill;
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
        return $this->formUsers;
    }

    /**
     * @return FormFieldData[]
     */
    public function getFormFields(): ?array
    {
        return $this->formFields;
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