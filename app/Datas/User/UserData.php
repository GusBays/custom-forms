<?php

namespace App\Datas\User;

use App\Traits\GetOrganizationId;
use Illuminate\Contracts\Support\Arrayable;

abstract class UserData implements Arrayable
{
    use GetOrganizationId;

    private ?int $organization_id = null;
    private ?string $name = null;
    private ?string $first_name = null;
    private ?string $last_name = null;
    private ?string $email = null;
    private ?string $password = null;
    private ?string $type = null;
    private ?string $token = null;

    public function __construct(
        ?int $organization_id = null,
        ?string $name = null,
        ?string $first_name = null,
        ?string $last_name = null,
        ?string $email = null,
        ?string $password = null,
        ?string $type = null,
        ?string $token = null
    )
    {
        $this->organization_id = $organization_id;
        $this->name = $name;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->type = $type;
        $this->token = $token;
    }

    public function getName(): ?string
    {
        return $this->name;
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
            'organization_id' => $this->getOrganizationId(),
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