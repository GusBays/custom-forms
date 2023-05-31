<?php

namespace App\Filters\Filler;

use Illuminate\Http\Request;

class FillerIdRequestFilter extends FillerFilter
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