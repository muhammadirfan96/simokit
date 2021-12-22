<?php

namespace App\Controllers;

use App\Models\LimasModel;

class Db_limas extends BaseController
{
    protected $limasModel;
    public function __construct()
    {
        $this->limasModel = new LimasModel();
    }

    public function index()
    {
        $data = [
            'title' => 'database | limas',
            'limas' => $this->limasModel->findAll(),
        ];

        return view('db_limas/index', $data);
    }

    public function prints($id)
    {
        return redirect()->to(base_url('/limas/' . $id));
    }

    public function delete($id)
    {
        //cari gambar
        $limas = $this->limasModel->find($id);

        //hapus gambar
        if (file_exists('img-5s/' . $limas['fotoSebelum'])) {
            unlink('img-5s/' . $limas['fotoSebelum']);
        }
        if (file_exists('img-5s/' . $limas['fotoSetelah'])) {
            unlink('img-5s/' . $limas['fotoSetelah']);
        }

        //hapus data
        $this->limasModel->delete($id);
        session()->setFlashdata('pesan', 'Data 5S ' . $limas['namaPeralatan'] . ' berhasil dihapus');
        return redirect()->to(base_url('/db_limas'));
    }
}
