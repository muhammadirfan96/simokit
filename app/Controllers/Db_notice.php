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
            'notice' => $notice
        ];
        // dd($data['notice']);
        return view('db_notice/details', $data);
    }

    public function edit()
    {
        $notice = $this->noticeModel->find($this->request->getVar('id'));

        $data = [
            'id' => $this->request->getVar('id'),
            'start_time' => $notice['start_time'],
            'end_time' => $notice['end_time'],
            'notice_to' => $this->request->getVar('shiftA') .
                $this->request->getVar('shiftB') .
                $this->request->getVar('shiftC') .
                $this->request->getVar('shiftD') .
                $this->request->getVar('SpvShiftA') .
                $this->request->getVar('SpvShiftB') .
                $this->request->getVar('SpvShiftC') .
                $this->request->getVar('SpvShiftD') .
                $this->request->getVar('manOP'),
            'content' => $notice['content'],
            'updated_by' => user()->fullname
        ];

        if ($this->request->getVar('start_time')) {
            $data['start_time'] = $this->request->getVar('start_time');
        }
        if ($this->request->getVar('end_time')) {
            $data['end_time'] = $this->request->getVar('end_time');
        }
        if ($this->request->getVar('content')) {
            $data['content'] = $this->request->getVar('content');
        }
        // dd($data);

        $this->noticeModel->setAllowedFields(array_keys($data));
        $this->noticeModel->save($data);

        session()->setFlashdata('pesanSuccess', 'anda telah mengubah notice');
        return redirect()->to(base_url('/db_notice'));
    }

    public function delete($id)
    {
        //hapus data
        $this->noticeModel->delete($id);
        session()->setFlashdata('pesanSuccess', 'notice berhasil dihapus');
        return redirect()->to(base_url('/db_notice'));
    }
}
