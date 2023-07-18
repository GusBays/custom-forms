<?php

namespace App\Datas\User;

use App\Traits\GetOrganizationId;
use Illuminate\Contracts\Support\Arrayable;

abstract class UserData implements Arrayable
{
    use GetOrganizationId;

    public function __construct(
        private ?int $organizationId = null,
        private ?string $name = null,
        private ?string $firstName = null,
        private ?string $lastName = null,
        private ?string $email = null,
        private ?string $password = null,
        private ?string $type = null,
        private ?string $token = null
    )
    {}

    public function getName(): ?string
    {
        return $this->name;
    }

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'first_name' => $this->getFirstName(),
            'last_name' => $this->getLastName(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'type' => $this->getType(),
            'token' => $this->getToken()
        ];
    }
}