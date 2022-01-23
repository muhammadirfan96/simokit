<?php

namespace App\Controllers;

use App\Models\ServiceRequestModel;
use App\Models\AtasanModel;
use Myth\Auth\Models\UserModel;

class Db_servicerequest extends BaseController
{
    protected $servicerequestModel, $UserModel, $AtasanModel;
    public function __construct()
    {
        $this->servicerequestModel = new ServiceRequestModel();
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
                $result[] = $this->servicerequestModel->where('diinput_oleh', $user['username'])->findAll();
            }
        } elseif (in_groups('admin')) {
            $result[] = $this->servicerequestModel->findAll();
        }

        $data = [
            'title' => 'database | servicerequest',
            'servicerequest' => $result
        ];

        return view('db_servicerequest/index', $data);
    }

    public function prints($id)
    {
        return redirect()->to(base_url('/servicerequest/' . $id));
    }

    public function delete($id)
    {
        //cari gambar
        $serviceRequest = $this->servicerequestModel->find($id);
        // dd($serviceRequest);

        //hapus gambar
        if ($serviceRequest['evidence1'] != '') {
            if (file_exists('img-sr/' . $serviceRequest['evidence1'])) {
                unlink('img-sr/' . $serviceRequest['evidence1']);
            }
        }
        if ($serviceRequest['evidence2'] != '') {
            if (file_exists('img-sr/' . $serviceRequest['evidence2'])) {
                unlink('img-sr/' . $serviceRequest['evidence2']);
            }
        }

        //hapus data
        $this->servicerequestModel->delete($id);
        session()->setFlashdata('pesan', 'Data SR ' . $serviceRequest['nomorSr'] . ' berhasil dihapus');
        return redirect()->to(base_url('/db_servicerequest'));
    }

    public function approve($id)
    {
        $serviceRequest = $this->servicerequestModel->find($id);
        $data = [
            'id' => $id,
            'approved' => $this->request->getVar('approve')
        ];

        session()->setFlashdata('pesan', 'Data SR ' . $serviceRequest['nomorSr'] . ' by ' . $serviceRequest['diinput_oleh'] . ' telah di approve');

        $this->servicerequestModel->setAllowedFields(array_keys($data));
        $this->servicerequestModel->save($data);
        return redirect()->to(base_url('/db_servicerequest'));
    }
}
