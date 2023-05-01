<?php

namespace App\Contracts;

class ApiRoutesEnum
{
    public const ORGANIZATIONS = '/organizations';

    public const USERS = '/users';

    public const USERS_ID = '/users/{id}';

    public const USERS_LOGIN = '/users/login';

    public const FORMS = '/forms';

    public const FORMS_ID = '/forms/{id}';

    public const FORM_USERS = '/forms/users';

    public const FORM_USERS_ID = '/forms/users/{id}';
}