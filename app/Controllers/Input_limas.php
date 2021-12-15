<?php

namespace App\Controllers;

class Input_limas extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'input | kegiatan 5s'
        ];

        return view('input_limas/index', $data);
    }
}
