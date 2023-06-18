<?php

namespace App\Contracts;

class ActionEnum
{
    public const CREATE_ORGANIZATION = '/action/create-organization';
    
    public const LOGIN = '/action/login';

    public const LOGOFF = '/action/logoff';

    public const RECOVER_PASSWORD = '/action/recover-password';
}