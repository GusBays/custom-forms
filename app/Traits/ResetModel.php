<?php

namespace App\Traits;

trait ResetModel
{
    protected function resetModelInstance()
    {
        $this->model = $this->model->newInstance();
    }
}