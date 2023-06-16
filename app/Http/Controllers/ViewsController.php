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

    public function recuperar()
    {
        return view('recover');
    }

    public function admin(array $data)
    {
        return view('admin', $data);
    }

    public function error(\Throwable $th)
    {
        return view('error', $th);
    }

    public function forms()
    {
        return view('forms');
    }

    public function form(array $data)
    {
        return view('form', $data);
    }

    public function formFieldsAnswer(array $data)
    {
        return view('formFieldAnswer', $data);
    }
}