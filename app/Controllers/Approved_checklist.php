<?php

namespace App\Controllers;

use App\Models\ChecklistModel;

class Approved_checklist extends BaseController
{
    protected $ChecklistModel;
    public function __construct()
    {
        $this->ChecklistModel = new ChecklistModel();
    }

    public function index()
    {

        $data = [
            'title' => 'approved',
            'checklist' => $this->ChecklistModel->where(['diinput_oleh' => user()->username, 'approved' => 'y'])->findAll()
        ];

        // dd($data);

        return view('approved_checklist/index', $data);
    }

    public function printChecklist($id)
    {
        return redirect()->to(base_url('/checklist/' . $id));
    }
}
