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
        $currentPage = $this->request->getVar('page_limas') ? $this->request->getVar('page_limas') : 1;

        //cek jika tombol cari di pencet
        if (empty($this->request->getVar('search'))) {
            //tampilkan semua data
            $limas = $this->limasModel;

            //cek jika sudah ada sesi
            //untuk membuat keyword berdasarkan sesi sebelumnya
            if (session('keyword')) {
                $keyword1 = session('keyword');

                //lakukan pencarian berdasarkan session
                $limas = $this->limasModel->search($keyword1);
            }
        } else {
            //buat session berdasarkan isi keyword
            $valueInput = $this->request->getVar('keyword');
            session()->set('keyword', $valueInput);
            $keyword1 = session('keyword');

            //lakukan pencarian berdasarkan session
            $limas = $this->limasModel->search($keyword1);
        }

        $data = [
            'title' => 'database | limas',
            'limas' => $limas->paginate(5, 'limas'),
            'pager' => $this->limasModel->pager,
            'currentPage' => $currentPage
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
