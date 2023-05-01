<?php

namespace App\Filters\FormUser;

use App\Contracts\Filter;

class FormUserFilter implements Filter
{
    private ?int $id = null;

    public function __construct(
        int $id = null
    )
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}