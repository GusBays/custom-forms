<?php

namespace App\Filters\Form;

use Illuminate\Http\Request;

class FormIdFilter extends FormFilter
{
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            $request->route('id')
        );
    }
}