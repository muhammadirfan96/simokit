<?php

namespace App\Controllers;

class Db_home extends BaseController
{
    public function index()
    {
        $data = [
            ['db_servicerequest', 'fa-pen', 'service request'],
            ['db_limas', 'fa-pen', 'kegiatan 5s'],
            ['db_checklist', 'fa-tasks', 'checklist sop'],
            ['db_users', 'fa-user', 'user list'],
            ['db_notice', 'fa-bullhorn', 'notice'],
            ['db_kwh', 'fa-keyboard', 'data kwh'],
            ['db_absensi', 'fa-book', 'data absensi'],
        ];

        $datas = [
            'title' => 'database | home',
            'data' => $data
        ];

        return view('db_home/index', $datas);
    }
}
