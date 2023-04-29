<?php

namespace App\Traits;

trait PerPage
{
    protected function perPage(): int
    {
        $limit = request()->query('limit');

        if (blank($limit)) return $this->model->getPerPage();

        $minPerPage = $this->model->getMinPerPage();

        $minResultsAccepted = max($limit, $minPerPage);

        return min($minResultsAccepted, $this->model->getMaxPerPage());
    }
}