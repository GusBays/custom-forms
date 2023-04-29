<?php

namespace App\Http\Adapters\User;

use App\Datas\User\UserData;
use Illuminate\Http\Request;

class UserRequestAdapter extends UserData
{
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            $request->input('organization_id', config('organization_id')),
            $request->input('name'),
            $request->input('first_name'),
            $request->input('last_name'),
            $request->input('email'),
            $request->input('password'),
            $request->input('type'),
        );
    }

    public static function fromOrganizationRequest(Request $request): self
    {
        $request->merge(['type' => 'owner']);

        return new self($request);
    }
}