<?php

namespace App\Filters\Form;

class FormIdFilter extends FormFilter
{
    public function __construct(
        int $id
    )
    {
        parent::__construct(
            $id
        );
    }
}