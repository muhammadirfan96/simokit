<?php

namespace App\Controllers;

use App\Models\ServiceRequestModel;

class Db_servicerequest extends BaseController
{
    protected $servicerequestModel;
    public function __construct()
    {
        $this->servicerequestModel = new ServiceRequestModel();
    }

    public function index()
    {
        $data = [
            'title' => 'database | servicerequest',
            'servicerequest' => $this->servicerequestModel->findAll(),
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
}
