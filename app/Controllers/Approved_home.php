<?php

namespace App\Controllers;

class Approved_home extends BaseController
{
    public function index()
    {
        $data = [
            ['approved_servicerequest', 'fa-pen', 'service request'],
            ['approved_limas', 'fa-pen', 'kegiatan 5s'],
            ['approved_checklist', 'fa-tasks', 'checklist sop']
        ];

        $datas = [
            'title' => 'approved | home',
            'data' => $data,
        ];

        return view('approved_home/index', $datas);
    }
}
