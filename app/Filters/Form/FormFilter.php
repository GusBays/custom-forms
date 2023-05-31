<?php

namespace App\Filters\Form;

use App\Contracts\Filter;

class FormFilter implements Filter
{
    private ?int $id = null;
    private ?string $slug = null;

    public function __construct(
        int $id = null,
        string $slug = null
    )
    {
        $this->id = $id;
        $this->slug = $slug;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }
}