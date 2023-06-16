<?php

namespace App\Filters\FormField;

use Illuminate\Http\Request;

class FormFieldIdRequestFilter extends FormFieldFilter
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