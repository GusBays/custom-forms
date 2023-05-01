<?php

namespace App\Http\Adapters\Filler;

use App\Datas\Filler\FillerUpdateData;
use Illuminate\Http\Request;

class FillerUpdateRequestAdapter extends FillerUpdateData
{
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            $request->route('id'),
            $request->input('organization_id', config('organization_id')),
            $request->input('name'),
            $request->input('first_name'),
            $request->input('last_name'),
            $request->input('email'),
            $request->input('created_at'),
            $request->input('updated_at')
        );

        foreach ($request->all() as $key => $value) {
            $this->setField($key, $value);
        }
    }
}