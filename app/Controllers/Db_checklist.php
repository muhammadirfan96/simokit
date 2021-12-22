<?php

namespace App\Controllers;

use App\Models\ChecklistModel;

class Db_checklist extends BaseController
{
    protected $ChecklistModel;
    public function __construct()
    {
        $this->ChecklistModel = new ChecklistModel();
    }

    public function index()
    {
        $data = [
            'title' => 'database | checklist',
            'checklist' => $this->ChecklistModel->findAll(),
        ];

        return view('db_checklist/index', $data);
    }

    public function prints($id)
    {
        return redirect()->to(base_url('/checklist/' . $id));
    }

    public function delete($id)
    {
        $checklist = $this->ChecklistModel->find($id);
        //hapus data
        $this->ChecklistModel->delete($id);
        session()->setFlashdata('pesan', 'Data Checklist ' . $checklist['namaPeralatan'] . ' berhasil dihapus');
        return redirect()->to(base_url('/db_checklist'));
    }
}
