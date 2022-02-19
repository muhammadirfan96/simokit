<?php

namespace App\Controllers;

use App\Models\ServiceRequestModel;

class Approved_servicerequest extends BaseController
{
    protected $ServiceRequestModel;
    public function __construct()
    {
        $this->ServiceRequestModel = new ServiceRequestModel();
    }

    public function index()
    {
        $like = user()->username;
        $where = "diinput_oleh LIKE '%$like%'";

        $data = [
            'title' => 'approved',
            'servicerequest' => $this->ServiceRequestModel->where($where)->findAll()
        ];

        return view('approved_servicerequest/index', $data);
    }

    public function printServicerequest($id)
    {
        return redirect()->to(base_url('/servicerequest/' . $id));
    }
}
