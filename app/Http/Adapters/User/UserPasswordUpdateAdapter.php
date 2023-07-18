<?php

namespace App\Http\Adapters\User;

use App\Datas\User\UserUpdateData;

class UserPasswordUpdateAdapter extends UserUpdateData
{
    public function __construct(
        int $id,
        string $password
    )
    {
        parent::__construct(
            id: $id,
            password: $password
        );

        $this->setField('password', $password);
    }
}