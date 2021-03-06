<?php

namespace App\Controllers;

use App\Models\AbsensiModel;
use App\Models\AtasanModel;
use Myth\Auth\Models\UserModel;

class Input_absensi extends BaseController
{
    protected $UserModel, $AtasanModel, $AbsensiModel, $ket;
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->AtasanModel = new AtasanModel();
        $this->AbsensiModel = new AbsensiModel();
        $this->ket = ['sakit', 'izin', 'cuti', 'sppd', 'mangkir'];
    }

    public function getUsers($bidang)
    {
        if (user()->bidang != 'admin') {
            $namaAtasan = user()->fullname;
            $bdgAtasan = user()->bidang;
        } else {
            $namaAtasan = $this->UserModel->asArray()->where('bidang', $bidang)->first()['fullname'];
            $bdgAtasan = $bidang;
        }
        $atasan = $this->AtasanModel->where('nama', $namaAtasan)->first();
        $bdg = $atasan['bawahan'];
        $where = "bidang = '$bdg' OR bidang = '$bdgAtasan'";
        $users = $this->UserModel->asArray()->where($where)->findAll();
        return $users;
    }

    public function status($bidang)
    {
        $status = [
            'admin' => ['checked', '', '', ''],
            'a' => ['checked', 'disabled', 'disabled', 'disabled'],
            'b' => ['disabled', 'checked', 'disabled', 'disabled'],
            'c' => ['disabled', 'disabled', 'checked',  'disabled'],
            'd' => ['disabled', 'disabled', 'disabled', 'checked'],
        ];
        $listBidang = [
            'admin' => 'admin',
            'a' => 'supervisor operasi shift a',
            'b' => 'supervisor operasi shift b',
            'c' => 'supervisor operasi shift c',
            'd' => 'supervisor operasi shift d',
        ];

        foreach ($listBidang as $key => $val) {
            if ($bidang == $val) {
                return $status[$key];
            }
        }
    }

    public function index()
    {
        $data = [
            'title' => 'input absensi',
            'users' => $this->getUsers('supervisor operasi shift a'),
            'ket' => $this->ket,
            'status' => $this->status(user()->bidang)
        ];

        return view('input_absensi/index', $data);
    }

    public function shiftA()
    {
        $data = [
            'users' => $this->getUsers('supervisor operasi shift a'),
            'ket' => $this->ket
        ];

        return view('input_absensi/table', $data);
    }
    public function shiftB()
    {
        $data = [
            'users' => $this->getUsers('supervisor operasi shift b'),
            'ket' => $this->ket
        ];

        return view('input_absensi/table', $data);
    }
    public function shiftC()
    {
        $data = [
            'users' => $this->getUsers('supervisor operasi shift c'),
            'ket' => $this->ket
        ];

        return view('input_absensi/table', $data);
    }
    public function shiftD()
    {
        $data = [
            'users' => $this->getUsers('supervisor operasi shift d'),
            'ket' => $this->ket
        ];

        return view('input_absensi/table', $data);
    }

    public function simpan()
    {
        $request = $this->request->getVar();
        $dataLama = $this->AbsensiModel
            ->where([
                'waktu' => $request['waktu'],
                'shift' => $request['shift'],
            ])
            ->first();

        $pesan = 'tidak ada data yang sama';
        if ($dataLama != null) {
            $this->AbsensiModel->delete($dataLama['id']);
            $pesan = 'data yang sama dihapus';
        }

        $listStatus = [
            'sakit' => [],
            'izin' => [],
            'cuti' => [],
            'sppd' => [],
            'mangkir' => [],
        ];

        foreach ($listStatus as $status => $arr) {
            foreach ($request as $key => $value) {
                if ($value == $status) {
                    $listStatus[$status][] = $key;
                }
            }
        }

        $sakit = implode(' | ', $listStatus['sakit']);
        $izin = implode(' | ', $listStatus['izin']);
        $cuti = implode(' | ', $listStatus['cuti']);
        $sppd = implode(' | ', $listStatus['sppd']);
        $mangkir = implode(' | ', $listStatus['mangkir']);

        $data = [
            'diinput' => user_id() . ' | ' . date('Y-m-d H:i:s'),
            'shift' => $request['shift'],
            'waktu' => $request['waktu'],
            'sakit' => $sakit,
            'izin' => $izin,
            'cuti' => $cuti,
            'sppd' => $sppd,
            'mangkir' => $mangkir,
            'catatan' => $request['catatan'],
        ];

        $this->AbsensiModel->setAllowedFields(array_keys($data));
        $this->AbsensiModel->save($data);

        session()->setFlashdata('pesanSuccess', 'data absensi berhasil ditambahkan ' . $pesan);
        return redirect()->to(base_url('/input_absensi'));
    }
}
