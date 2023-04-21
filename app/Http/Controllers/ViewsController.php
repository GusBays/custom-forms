<?php

namespace App\Http\Controllers;

class ViewsController
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

    public function admin()
    {
        return view('admin');
    }
}