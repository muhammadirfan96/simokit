<?php

namespace App\Controllers;

use App\Models\LimasModel;

class Approved_limas extends BaseController
{
    protected $LimasModel;
    public function __construct()
    {
        $this->LimasModel = new LimasModel();
    }

    public function index()
    {

        $data = [
            'title' => 'approved',
            'limas' => $this->LimasModel->where(['diinput_oleh' => user()->username, 'approved' => 'y'])->findAll()
        ];

        return view('approved_limas/index', $data);
    }

    public function printLimas($id)
    {
        return redirect()->to(base_url('/limas/' . $id));
    }
}
