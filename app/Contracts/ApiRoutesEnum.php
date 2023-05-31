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

    public const FORMS_SLUG = '/forms/{slug}';

    public const FORM_USERS = '/forms/users';

    public const FORM_USERS_ID = '/forms/users/{id}';

    public const FORM_FIELDS = '/forms/fields';

    public const FORM_FIELDS_ID = '/forms/fields/{id}';

    public const FILLERS = '/fillers';

    public const FILLERS_ID = '/fillers/{id}';

    public const FORM_FIELDS_ANSWERS = '/forms/fields/answers';
}