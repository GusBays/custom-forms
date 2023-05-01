<?php

namespace App\Filters\FormUser;

use Illuminate\Http\Request;

class FormUserIdFilter extends FormUserFilter
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