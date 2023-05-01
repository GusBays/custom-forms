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
            $request->input('first_name'),
            $request->input('last_name'),
            $request->input('email')
        );
    }
}