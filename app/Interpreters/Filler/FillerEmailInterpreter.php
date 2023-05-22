<?php

namespace App\Interpreters\Filler;

use App\Filters\Filler\FillerFilter;
use App\Interpreters\DbInterpreter;
use Illuminate\Database\Eloquent\Builder;

class FillerEmailInterpreter extends DbInterpreter
{
    private FillerFilter $filter;

    public function __construct(
       FillerFilter $filter 
    )
    {
        $this->filter = $filter;
    }

    public function interpret(): Builder
    {
        $email = $this->filter->getEmail();

        if (blank($email)) return $this->query;

        return $this->query->where('email', $email);
    }
}