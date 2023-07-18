<?php

namespace App\Http\Adapters\Filler;

use App\Datas\Filler\FillerData;
use Illuminate\Http\Request;

class FillerRequestAdapter extends FillerData
{
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            firstName: $request->input('first_name'),
            lastName: $request->input('last_name'),
            email: $request->input('email')
        );
    }
}