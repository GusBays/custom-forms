<?php

namespace App\Http\Adapters\FormUser;

use App\Datas\FormUser\FormUserUpdateData;
use App\Http\Adapters\User\UserModelAdapter;
use App\Models\FormUser;
use Illuminate\Database\Eloquent\Collection;

class FormUserModelAdapter extends FormUserUpdateData
{
    public function __construct(
        FormUser $formUser
    )
    {
        parent::__construct(
            id: $formUser->id,
            organizationId: $formUser->getAttribute('organization_id') ?? $formUser->getAttribute('form_users.organization_id'),
            formId: $formUser->form_id,
            userId: $formUser->user_id,
            type: $formUser->type,
            createdAt: $formUser->created_at,
            updatedAt: $formUser->updated_at,
            user: new UserModelAdapter($formUser->user)
        );
    }

    public static function createFromFormModel(Collection $formUsers): array
    {
        return $formUsers->mapInto(self::class)->all();
    }

    public static function collection(array $formUsers): array
    {
        return collect($formUsers)->mapInto(self::class)->all();
    }
}