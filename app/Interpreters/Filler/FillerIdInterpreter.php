<?php

namespace App\Interpreters\Filler;

use App\Filters\Filler\FillerFilter;
use App\Interpreters\DbInterpreter;
use Illuminate\Database\Eloquent\Builder;

class FillerIdInterpreter extends DbInterpreter
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
        $id = $this->filter->getId();

        if (blank($id)) return $this->query;

        return $this->query->where('id', $id);
    }
}