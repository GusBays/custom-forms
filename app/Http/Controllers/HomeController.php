<?php

namespace App\Http\Controllers;

class HomeController
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