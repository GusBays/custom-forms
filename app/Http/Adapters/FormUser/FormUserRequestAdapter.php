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
        $toMergeFields = fn (Request $request) => $request->merge([
            'form_id' => $request->route('id'),
            'user_id' => config('user_id'),
            'type' => 'creator',
        ]);

        return collect($request->input('form_users'))->map($toMergeFields)->mapInto(self::class)->all();
    }
}