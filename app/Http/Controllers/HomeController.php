<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;

class HomeController extends BaseController
{
    public function home()
    {
        return view('home');
    }

    public function entrar()
    {
        return view('login');
    }

    public function cadastro()
    {
        return view('register');
    }
}