<?php

namespace App\Filters\Filler;

class FillerIdFilter extends FillerFilter
{
    public function __construct(
        int $id
    )
    {
        parent::__construct(
            $id,
            null
        );
    }
}