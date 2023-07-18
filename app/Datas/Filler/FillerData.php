<?php

namespace App\Datas\Filler;

use Illuminate\Contracts\Support\Arrayable;

abstract class FillerData implements Arrayable
{
    public function __construct(
        private ?string $firstName = null,
        private ?string $lastName = null,
        private ?string $email = null
    )
    {}

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
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