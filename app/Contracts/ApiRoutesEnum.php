<?php

namespace App\Contracts;

class ApiRoutesEnum
{
    public const ORGANIZATIONS = '/organizations';

    public const USERS = '/users';

    public const USERS_ID = '/users/{id}';

    public const USERS_LOGIN = '/users/login';

    public const USERS_RECOVER_PASSWORD = '/users/recover-password';

    public const FORMS = '/forms';

    public const FORMS_ID = '/forms/{id}';

    public const FORMS_SLUG = '/forms/{slug}';

    public const FORM_USERS = '/form-users';

    public const FORM_USERS_ID = '/form-users/{id}';

    public const FORM_FIELDS = '/form-fields';

    public const FORM_FIELDS_ID = '/form-fields/{id}';

    public const FILLERS = '/fillers';

    public const FILLERS_ID = '/fillers/{id}';

    public const FORM_ANSWERS = '/form-answers';
}