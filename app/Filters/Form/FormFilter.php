<?php

namespace App\Filters\Form;

use App\Contracts\Filter;

class FormFilter implements Filter
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