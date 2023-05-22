<?php

namespace App\Filters\Filler;

use App\Contracts\Filter;

class FillerFilter implements Filter
{
    private ?int $id = null;
    private ?string $email = null;

    public function __construct(
        int $id = null,
        string $email = null
    )
    {
        $this->id = $id;
        $this->email = $email;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
}