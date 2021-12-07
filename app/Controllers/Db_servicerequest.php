<?php

namespace App\Controllers;

use App\Models\ServiceRequestModel;

use function PHPUnit\Framework\fileExists;

class Db_servicerequest extends BaseController
{
    protected $servicerequestModel;
    public function __construct()
    {
        $this->servicerequestModel = new ServiceRequestModel();
    }
    public function index()
    {
        $currentPage = $this->request->getVar('page_srcm') ? $this->request->getVar('page_srcm') : 1;

        //cek jika tombol cari di pencet
        if (empty($this->request->getVar('search'))) {
            //tampilkan semua data
            $sr = $this->servicerequestModel;

            //cek jika sudah ada sesi
            //untuk membuat keyword berdasarkan sesi sebelumnya
            if (session('keyword')) {
                $keyword1 = session('keyword');

                //lakukan pencarian berdasarkan session
                $sr = $this->servicerequestModel->search($keyword1);
            }
        } else {
            //buat session berdasarkan isi keyword
            $valueInput = $this->request->getVar('keyword');
            session()->set('keyword', $valueInput);
            $keyword1 = session('keyword');

            //lakukan pencarian berdasarkan session
            $sr = $this->servicerequestModel->search($keyword1);
        }

        $data = [
            'title' => 'database | servicerequest',
            'servicerequest' => $sr->paginate(5, 'srcm'),
            'pager' => $this->servicerequestModel->pager,
            'currentPage' => $currentPage
        ];

        return view('db_servicerequest/index', $data);
    }

    public function table($keyword)
    {
        if ($keyword) {
            $sr = $this->servicerequestModel->search($keyword)->findAll();
        } else {
            $sr = $this->servicerequestModel->findAll();
        }

        $data = [
            'servicerequest' => $sr,
            'currentPage' => 1
        ];

        return view('db_servicerequest/table', $data);
    }

    public function prints($id)
    {
        return redirect()->to(base_url('/servicerequest/' . $id));
    }

    public function delete($id)
    {
        //cari gambar
        $serviceRequest = $this->servicerequestModel->find($id);

        //hapus gambar
        if (file_exists(base_url() . '/img-sr/' . $serviceRequest['evidence1'])) {
            unlink('img-sr/' . $serviceRequest['evidence1']);
        }
        if (file_exists(base_url() . '/img-sr/' . $serviceRequest['evidence2'])) {
            unlink('img-sr/' . $serviceRequest['evidence2']);
        }

        //hapus data
        $this->servicerequestModel->delete($id);
        session()->setFlashdata('pesan', 'Data SR ' . $serviceRequest['nomorSr'] . ' berhasil dihapus');
        return redirect()->to(base_url('/db_servicerequest'));
    }
}
