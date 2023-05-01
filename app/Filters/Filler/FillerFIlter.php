<?php

namespace App\Filters\Filler;

use App\Contracts\Filter;

class FillerFilter implements Filter
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