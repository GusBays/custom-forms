<?php

namespace App\Filters\FormField;

use App\Contracts\Filter;

class FormFieldFilter implements Filter
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