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
            $formUser->id,
            $formUser->getAttribute('organization_id') ?? $formUser->getAttribute('form_users.organization_id'),
            $formUser->form_id,
            $formUser->user_id,
            $formUser->type,
            $formUser->created_at,
            $formUser->updated_at,
            new UserModelAdapter($formUser->user)
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