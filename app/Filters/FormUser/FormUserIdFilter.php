<?php

namespace App\Filters\FormUser;

class FormUserIdFilter extends FormUserFilter
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