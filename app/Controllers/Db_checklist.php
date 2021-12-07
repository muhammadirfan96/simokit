<?php

namespace App\Controllers;

use App\Models\ChecklistModel;

use function PHPUnit\Framework\fileExists;

class Db_checklist extends BaseController
{
    protected $ChecklistModel;
    public function __construct()
    {
        $this->ChecklistModel = new ChecklistModel();
    }
    public function index()
    {
        $currentPage = $this->request->getVar('page_checklist') ? $this->request->getVar('page_checklist') : 1;

        //cek jika tombol cari di pencet
        if (empty($this->request->getVar('search'))) {
            //tampilkan semua data
            $checklist = $this->ChecklistModel;

            //cek jika sudah ada sesi
            //untuk membuat keyword berdasarkan sesi sebelumnya
            if (session('keyword')) {
                $keyword1 = session('keyword');

                //lakukan pencarian berdasarkan session
                $checklist = $this->ChecklistModel->search($keyword1);
            }
        } else {
            //buat session berdasarkan isi keyword
            $valueInput = $this->request->getVar('keyword');
            session()->set('keyword', $valueInput);
            $keyword1 = session('keyword');

            //lakukan pencarian berdasarkan session
            $checklist = $this->ChecklistModel->search($keyword1);
        }

        $data = [
            'title' => 'database | checklist peralatan',
            'servicerequest' => $checklist->paginate(5, 'checklist'),
            'pager' => $this->ChecklistModel->pager,
            'currentPage' => $currentPage
        ];

        //dd($data);

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
        session()->setFlashdata('pesan', 'Data Checklist '.$checklist['namaPeralatan'].' berhasil dihapus');
        return redirect()->to(base_url('/db_checklist'));
    }
}
