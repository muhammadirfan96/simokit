<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'home | simokit'
        ];
        return view('home/index', $data);
    }
}
