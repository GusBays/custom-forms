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

    public static function createFromFormRequest(array $formUsers): array
    {
        $toRequest = fn (array $formUser) => new Request($formUser);
        return collect($formUsers)
            ->map($toRequest)
            ->mapInto(self::class)
            ->all();
    }
}