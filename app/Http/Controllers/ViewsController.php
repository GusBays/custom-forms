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

    public function admin(array $organization)
    {
        return view('admin', $organization);
    }

    public function error(\Throwable $th)
    {
        return view('error', $th);
    }
}