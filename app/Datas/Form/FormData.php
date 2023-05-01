<?php

namespace App\Datas\Form;

use Illuminate\Contracts\Support\Arrayable;

class FormData implements Arrayable
{
    private string $name;
    private ?string $available_until = null;
    private ?int $fill_limit = null;
    private bool $should_notify_each_fill = true;
    private bool $active = true; 

    public function __construct(
        string $name,
        string $available_until = null,
        int $fill_limit = null,
        bool $should_notify_each_fill = true,
        bool $active = true
    )
    {
        $this->name = $name;
        $this->available_until = $available_until;
        $this->fill_limit = $fill_limit;
        $this->should_notify_each_fill = $should_notify_each_fill;
        $this->active = $active;
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