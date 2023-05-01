<?php

namespace App\Http\Adapters\FormUser;

use App\Datas\FormUser\FormUserData;
use Illuminate\Http\Request;

class FormUserRequestAdapter extends FormUserData
{
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            $request->input('form_id'),
            $request->input('user_id'),
            $request->input('type')
        );
    }

    public static function createFromFormRequest(Request $request): array
    {
        return collect($request->input('form_users'))->mapInto(self::class)->all();
    }
}