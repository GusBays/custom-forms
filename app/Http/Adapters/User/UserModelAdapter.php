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
            id: $user->id,
            organizationId: $user->getAttribute('organization_id') ?? $user->getAttribute('users.organization_id'),
            name: $user->name,
            firstName: $user->first_name,
            lastName: $user->last_name,
            email: $user->email,
            password: $user->password,
            type: $user->type,
            token: $user->token,
            createdAt: $user->created_at,
            updatedAt: $user->updated_at
        );
    }

    public static function collection(Collection | array $users): array
    {
        return collect($users)->mapInto(self::class)->all();
    }
}