<?php

namespace App\Controllers;

class Approved_home extends BaseController
{
    public function index()
    {

        $data = [
            'title' => 'approved | home'
        ];

        return view('approved_home/index', $data);
    }
}
