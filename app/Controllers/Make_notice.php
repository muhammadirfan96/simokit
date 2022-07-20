<?php

namespace App\Controllers;

use App\Models\NoticeModel;

class Make_notice extends BaseController
{
    protected $noticeModel;

    public function __construct()
    {
        $this->noticeModel = new NoticeModel();
    }

    public function index()
    {
        $data = [
            'title' => 'make notice',
            'validation' => \Config\Services::validation()
        ];

        return view('make_notice/index', $data);
    }
    public function post()
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
            return redirect()->to(base_url('/make_notice'))->withInput();
        }
        $data = [
            'start_time' => $this->request->getVar('start_time'),
            'end_time' => $this->request->getVar('end_time'),
            'maked_by' => user()->fullname . ' | ' . user()->bidang,
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
            'updated_by' => ''
        ];
        // dd($data);

        $this->noticeModel->setAllowedFields(array_keys($data));
        $this->noticeModel->save($data);

        session()->setFlashdata('pesanSuccess', 'anda telah menambahkan notice baru');
        return redirect()->to(base_url('/make_notice'));
    }
}
