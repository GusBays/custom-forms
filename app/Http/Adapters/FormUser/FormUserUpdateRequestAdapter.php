<?php

namespace App\Http\Adapters\FormUser;

use App\Datas\FormUser\FormUserUpdateData;
use Illuminate\Http\Request;

class FormUserUpdateRequestAdapter extends FormUserUpdateData
{
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            $request->route('id') ?? $request->input('id'),
            $request->input('organization_id', config('organization_id')),
            $request->input('form_id'),
            $request->input('user_id'),
            $request->input('type'),
            $request->input('created_at'),
            $request->input('updated_at')
        );

        foreach($request->all() as $key => $value) {
            $this->setField($key, $value);
        }
    }

    public static function createFromFormUpdateRequest(array $users): array
    {
        $toRequest = fn (array $user) => new Request($user);
        return collect($users)
            ->map($toRequest)
            ->mapInto(self::class)
            ->all();
    }
}