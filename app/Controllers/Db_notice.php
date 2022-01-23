<?php

namespace App\Controllers;

use App\Models\NoticeModel;

class Db_notice extends BaseController
{
    protected $noticeModel;
    public function __construct()
    {
        $this->noticeModel = new NoticeModel();
    }

    public function index()
    {
        $fullname = user()->fullname;
        $where = "maked_by LIKE '%$fullname%'";
        if (in_groups('supervisor operasi shift a') || in_groups('supervisor operasi shift b') || in_groups('supervisor operasi shift c') || in_groups('supervisor operasi shift d')) {
            $result = $this->noticeModel->where($where)->findAll();
        } elseif (in_groups('admin')) {
            $result = $this->noticeModel->findAll();
        }

        $data = [
            'title' => 'database | notice',
            'notice' => $result
        ];

        return view('db_notice/index', $data);
    }

    public function details($id)
    {
        $notice = $this->noticeModel->find($id);
        $data = [
            'title' => 'notice details',
            'notice' => $notice,
            'validation' => \Config\Services::validation()
        ];
        // dd($data['notice']);
        return view('db_notice/details', $data);
    }

    public function edit()
    {
        $dataValidate = [
            'start_time' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tanggal harus di isi'
                ]
            ],
            'end_time' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tanggal harus di isi'
                ]
            ],
            'content' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'isi notifikasi tidak boleh kosong'
                ]
            ]
        ];

        if (!$this->validate($dataValidate)) {
            return redirect()->to(base_url('/db_notice/' . $this->request->getVar('id')))->withInput();
        }

        $data = [
            'id' => $this->request->getVar('id'),
            'start_time' => $this->request->getVar('start_time'),
            'end_time' => $this->request->getVar('end_time'),
            'maked_by' => $this->request->getVar('maked_by'),
            'notice_to' =>
            $this->request->getVar('shiftA') .
                $this->request->getVar('shiftB') .
                $this->request->getVar('shiftC') .
                $this->request->getVar('shiftD') .
                $this->request->getVar('SpvShiftA') .
                $this->request->getVar('SpvShiftB') .
                $this->request->getVar('SpvShiftC') .
                $this->request->getVar('SpvShiftD') .
                $this->request->getVar('manOP'),
            'content' => $this->request->getVar('content'),
            'updated_by' => user()->fullname
        ];
        // dd($data);

        $this->noticeModel->setAllowedFields(array_keys($data));
        $this->noticeModel->save($data);

        session()->setFlashdata('pesan', 'anda telah mengubah notice');
        return redirect()->to(base_url('/db_notice'));
    }

    public function delete($id)
    {
        //hapus data
        $this->noticeModel->delete($id);
        session()->setFlashdata('pesan', 'notice berhasil dihapus');
        return redirect()->to(base_url('/db_notice'));
    }
}
