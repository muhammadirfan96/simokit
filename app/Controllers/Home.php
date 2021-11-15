<?php

namespace App\Controllers;

class Home extends BaseController
{
    // public function login()
    // {
    //     return view('auth/login');
    // }
    // public function register()
    // {
    //     return view('auth/register');
    // }
    public function index()
    {
        return view('user/index');
    }
}
