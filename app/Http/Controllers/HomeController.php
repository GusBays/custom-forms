<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;

class HomeController extends BaseController
{
    public function __construct()
    {
        
    }

    public function home()
    {
        return view('home');
    }
}