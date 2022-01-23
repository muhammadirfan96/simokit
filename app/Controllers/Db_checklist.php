<?php

namespace App\Controllers;

use App\Models\ChecklistModel;
use App\Models\AtasanModel;
use Myth\Auth\Models\UserModel;

class Db_checklist extends BaseController
{
    protected $ChecklistModel, $UserModel, $AtasanModel;
    public function __construct()
    {
        $this->ChecklistModel = new ChecklistModel();
        $this->UserModel = new UserModel();
        $this->AtasanModel = new AtasanModel();
    }

    public function index()
    {
        if (in_groups('supervisor operasi shift a') || in_groups('supervisor operasi shift b') || in_groups('supervisor operasi shift c') || in_groups('supervisor operasi shift d')) {
            $atasan = $this->AtasanModel->where('nama', user()->fullname)->first();
            $users = $this->UserModel->asArray()->where('bidang', $atasan['bawahan'])->findAll();

            $result = [];
            foreach ($users as $user) {
                $result[] = $this->ChecklistModel->where('diinput_oleh', $user['username'])->findAll();
            }
        } elseif (in_groups('admin')) {
            $result[] = $this->ChecklistModel->findAll();
        }

        $data = [
            'title' => 'database | checklist',
            'checklist' => $result
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

    public function approve($id)
    {
        $checklist = $this->ChecklistModel->find($id);
        $data = [
            'id' => $id,
            'approved' => $this->request->getVar('approve')
        ];

        session()->setFlashdata('pesan', 'Data Checklist ' . $checklist['namaPeralatan'] . ' by ' . $checklist['diinput_oleh'] . ' telah di approve');

        $this->ChecklistModel->setAllowedFields(array_keys($data));
        $this->ChecklistModel->save($data);
        return redirect()->to(base_url('/db_checklist'));
    }
}
