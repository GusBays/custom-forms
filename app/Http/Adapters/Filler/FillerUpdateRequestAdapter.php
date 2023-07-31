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
            id: $request->route('id') ?? $request->input('id'),
            organizationId: $request->input('organization_id', config('organization_id')),
            name: $request->input('name'),
            firstName: $request->input('first_name'),
            lastName: $request->input('last_name'),
            email: $request->input('email'),
            createdAt: $request->input('created_at'),
            updatedAt: $request->input('updated_at')
        );

        foreach ($request->all() as $key => $value) {
            $this->setField($key, $value);
        }
    }
}