<?php

namespace App\Filters\User;

use App\Contracts\Filter;

abstract class UserFilter implements Filter
{
    private ?int $id = null;
    private ?string $email = null;
    private ?string $token = null;

    public function __construct(
        int $id = null,
        string $email = null,
        string $token = null
    )
    {
        $this->id = $id;
        $this->email = $email;
        $this->token = $token;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }
}