<?php

namespace App\Interpreters;

use Illuminate\Database\Eloquent\Builder;

abstract class DbInterpreter
{
    protected Builder $query;

    abstract function interpret(): Builder;

    public function setQuery(Builder $query): self
    {
        $this->query = $query;

        return $this;
    }
}