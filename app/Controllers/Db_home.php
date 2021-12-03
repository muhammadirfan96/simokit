<?php

namespace App\Controllers;

class Db_home extends BaseController
{
    public function index()
    {

        $data = [
            'title' => 'database | home'
        ];

        return view('db_home/index', $data);
    }
}
