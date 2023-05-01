<?php

namespace App\Http\Adapters\FormUser;

use App\Datas\FormUser\FormUserData;

class FormUserCreatorAdapter extends FormUserData
{
    public function __construct(
        int $form_id
    )
    {
        parent::__construct(
            $form_id,
            config('user_id'),
            'creator'
        );
    }
}