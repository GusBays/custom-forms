<?php

namespace App\Http\Adapters\User;

use App\Datas\User\UserUpdateData;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserModelAdapter extends UserUpdateData
{
    public function __construct(
        User $user
    )
    {
        parent::__construct(
            $user->id,
            $user->getAttribute('organization_id') ?? $user->getAttribute('users.organization_id'),
            $user->name,
            $user->first_name,
            $user->last_name,
            $user->email,
            $user->password,
            $user->type,
            $user->token,
            $user->created_at,
            $user->updated_at
        );
    }

    public static function collection(array $users): array
    {
        return collect($users)->mapInto(self::class)->all();
    }

    public static function fromOrganizationModel(Collection $users): array
    {
        return $users->mapInto(self::class)->all();
    }
}