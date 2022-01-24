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

        $data = [
            'title' => 'approved',
            'servicerequest' => $this->ServiceRequestModel->where(['diinput_oleh' => user()->username, 'approved' => 'y'])->findAll()
        ];

        return view('approved_servicerequest/index', $data);
    }

    public function printServicerequest($id)
    {
        return redirect()->to(base_url('/servicerequest/' . $id));
    }
}
