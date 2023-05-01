<?php

namespace App\Datas\Filler;

use Illuminate\Contracts\Support\Arrayable;

class FillerData implements Arrayable
{
    private ?string $first_name = null;
    private ?string $last_name = null;
    private ?string $email = null;

    public function __construct(
        string $first_name = null,
        string $last_name = null,
        string $email = null
    )
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->getFirstName(),
            'last_name' => $this->getLastName(),
            'email' => $this->getEmail(),
        ];
    }
}