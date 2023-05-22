<?php

namespace App\Filters\Filler;

class FillerEmailFilter extends FillerFilter
{
    public function __construct(
        string $email
    )
    {
        parent::__construct(
            null,
            $email
        );
    }
}