<?php

namespace App\Contracts;

class RedirectEnum
{
    public const HOME = '/';

    public const ENTRAR = '/admin/entrar';

    public const CADASTRO = '/admin/cadastro';

    public const RECUPERAR = '/recuperar-senha';

    public const ADMIN = '/admin';

    public const FORMS = '/admin/formularios';

    public const USERS = '/admin/usuarios';

    public const USER_ID = '/admin/usuarios/{id}';

    public const USER_NEW = '/admin/usuario/novo';
}