<?php

namespace App\Repositories;

use App\Models\Form;

class FormRepository extends BaseRepository
{
    protected $model;

    public function __construct(
        Form $model
    )
    {
        parent::__construct($model);

        $this->query->with('formUsers');
    }
}