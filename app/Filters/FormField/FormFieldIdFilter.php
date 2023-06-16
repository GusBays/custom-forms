<?php

namespace App\Filters\FormField;

class FormFieldIdFilter extends FormFieldFilter
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