<?php

namespace App\Controllers;

use App\Models\LimasModel;
use App\Models\AtasanModel;
use Myth\Auth\Models\UserModel;

class Db_limas extends BaseController
{
    protected $limasModel, $UserModel, $AtasanModel;
    public function __construct()
    {
        $this->limasModel = new LimasModel();
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
                $result[] = $this->limasModel->where('diinput_oleh', $user['username'])->findAll();
            }
        } elseif (in_groups('admin')) {
            $result[] = $this->limasModel->findAll();
        }

        $data = [
            'title' => 'database | limas',
            'limas' => $result,
        ];

        // dd($data);

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

    public function approve($id)
    {
        $Limas = $this->limasModel->find($id);
        $data = [
            'id' => $id,
            'approved' => $this->request->getVar('approve')
        ];

        session()->setFlashdata('pesan', 'Data kegiatan 5s ' . $Limas['namaPeralatan'] . ' by ' . $Limas['diinput_oleh'] . ' telah di approve');

        $this->limasModel->setAllowedFields(array_keys($data));
        $this->limasModel->save($data);
        return redirect()->to(base_url('/db_limas'));
    }
}
