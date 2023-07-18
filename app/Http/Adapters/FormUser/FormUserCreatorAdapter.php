<?php

namespace App\Http\Adapters\FormUser;

use App\Datas\FormUser\FormUserData;

class FormUserCreatorAdapter extends FormUserData
{
    public function __construct(
        int $formId
    )
    {
        parent::__construct(
            formId: $formId,
            userId: config('user_id'),
            type: 'creator'
        );
    }
}