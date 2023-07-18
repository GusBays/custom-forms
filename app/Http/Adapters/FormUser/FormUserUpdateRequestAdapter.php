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
            id: $request->route('id') ?? $request->input('id'),
            organizationId: $request->input('organization_id', config('organization_id')),
            formId: $request->input('form_id'),
            userId: $request->input('user_id'),
            type: $request->input('type'),
            createdAt: $request->input('created_at'),
            updatedAt: $request->input('updated_at')
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