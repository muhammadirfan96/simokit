<?php

namespace App\Controllers;

use App\Models\AbsensiModel;
use Myth\Auth\Models\UserModel;

class Db_absensi extends BaseController
{
    protected $UserModel, $KwhModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->AbsensiModel = new AbsensiModel();
    }

    public function getUsers($bidang)
    {
        if (user()->bidang != 'admin') {
            $atasan = $this->AtasanModel->where('nama', user()->fullname)->first();
            $users = $this->UserModel->asArray()->where('bidang', $atasan['bawahan'])->findAll();
            return $users;
        }

        $namaAtasan = $this->UserModel->asArray()->where('bidang', $bidang)->first()['fullname'];
        $atasan = $this->AtasanModel->where('nama', $namaAtasan)->first();
        $users = $this->UserModel->asArray()->where('bidang', $atasan['bawahan'])->findAll();
        return $users;
    }

    public function index()
    {
        $data = $this->AbsensiModel->findAll();
        if (user()->bidang != 'admin') {
            $shift = explode(' operasi ', user()->bidang)[1];
            $data = $this->AbsensiModel->where('shift', $shift)->findAll();
        }

        $nama = [];
        $waktu = [];
        foreach ($data as $row) {
            $nama[] = $this->UserModel
                ->asArray()
                ->where(
                    ['id' => explode(' | ', $row['diinput'])[0]]
                )
                ->first()['fullname'];
            $waktu[] = explode(' | ', $row['diinput'])[1];
        }

        $datas = [
            'title' => 'database | absensi',
            'nama' => $nama,
            'waktu' => $waktu,
            'absensi' => $data
        ];

        return view('db_absensi/index', $datas);
    }

    public function delete($id)
    {
        $this->AbsensiModel->delete($id);

        session()->setFlashdata('pesanSuccess', 'data absensi berhasil dihapus');
        return redirect()->to(base_url('/db_absensi'));
    }
}
