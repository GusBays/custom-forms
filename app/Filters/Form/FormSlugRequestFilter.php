<?php

namespace App\Filters\Form;

use Illuminate\Http\Request;

class FormSlugRequestFilter extends FormFilter
{
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            null,
            $request->route('slug')
        );
    }
}