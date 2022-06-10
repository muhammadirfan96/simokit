<?php

namespace App\Controllers;

use Myth\Auth\Models\UserModel;
use App\Models\AtasanModel;
use App\Models\ListOfKpiModel;
use App\Models\UsersKpiModel;

class Kpi_monitoring extends BaseController
{
    protected $UserModel, $AtasanModel, $ListOfKpiModel, $UserKpiModel, $db;
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->AtasanModel = new AtasanModel();
        $this->ListOfKpiModel = new ListOfKpiModel();
        $this->UserKpiModel = new UsersKpiModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        if (in_groups('supervisor operasi shift a') || in_groups('supervisor operasi shift b') || in_groups('supervisor operasi shift c') || in_groups('supervisor operasi shift d')) {
            $atasan = $this->AtasanModel->where('nama', user()->fullname)->first();
            $b = $atasan['bawahan'];
            // $u = user()->username;
            $where = "bidang = '$b'";
            $users = $this->UserModel->asArray()->where($where)->findAll();
        } elseif (in_groups('admin')) {
            $users = $this->UserModel->asArray()->findAll();
        }

        $data = [
            'title' => 'database | users',
            'users' => $users
        ];
        // dd($data);

        return view('kpi_monitoring/index', $data);
    }

    public function details($id)
    {
        $listKpi = $this->ListOfKpiModel->findAll();

        $builder = $this->db->table('list_of_kpi');
        $builder->where('users_kpi.user_id', $id);
        $builder->join('users_kpi', 'list_of_kpi.id = users_kpi.kpi_id');
        $join = $builder->get()->getResult('array');

        $user = $this->UserModel->asArray()->find($id);

        $data = [
            'title' => 'detail kpi',
            'listKpi' => $listKpi,
            'kpiUser' => $join,
            'user' => $user
        ];

        return view('kpi_monitoring/details', $data);
    }

    public function add()
    {
        $idUser = $this->request->getVar('user_id');
        $kpiLama = $this->UserKpiModel->where('user_id', $idUser)->findAll();

        $idKpiBaru = $this->request->getVar('kpi_id');

        $idKpilama = [];
        foreach ($kpiLama as $row) {
            $idKpilama[] = $row['kpi_id'];
        }

        $idKpiValid = array_values(array_diff($idKpiBaru, $idKpilama));
        $idKpiInValid = array_values(array_diff($idKpiBaru, $idKpiValid));

        if (empty($idKpiInValid)) {
            $pesan = 'semua valid';
        } else {
            $pesan = 'sebagian tidak ditambahkan karena sudah ditambahkan sebelumnya';
        }

        for ($i = 0; $i < count($idKpiValid); $i++) {
            $this->UserKpiModel->save([
                'user_id' => intval($idUser),
                'kpi_id' => intval($idKpiValid[$i])
            ]);
        }

        if (count($idKpiValid) > 0) {
            session()->setFlashdata('pesanSuccess', 'kpi baru telah di tambahkan. ' . $pesan);
        } else {
            session()->setFlashdata('pesanWarning', 'tidak ada kpi baru yang ditambahkan. semua kpi sudah ditambahkan sebelumnya');
        }

        return redirect()->to(base_url('/kpi_monitoring/details/' . $this->request->getVar('user_id')));
    }

    public function delete($kpiId, $userId)
    {
        $dataLama = $this->UserKpiModel->find($kpiId);
        if (!empty($dataLama['evidence'])) {
            if (file_exists('pdf-kpi/' . $dataLama['evidence'])) {
                unlink('pdf-kpi/' . $dataLama['evidence']);
            }
        }

        $this->UserKpiModel->delete($kpiId);

        session()->setFlashdata('pesanSuccess', 'kpi telah di hapus');
        return redirect()->to(base_url('/kpi_monitoring/details/' . $userId));
    }

    public function approve($kpiId, $userId)
    {
        $this->UserKpiModel->save([
            'id' => $kpiId,
            'approve' => 'y'
        ]);
        session()->setFlashdata('pesanSuccess', 'evidence kpi telah diaprove');
        return redirect()->to(base_url('/kpi_monitoring/details/' . $userId));
    }

    public function reset($kpiId, $userId)
    {
        $dataLama = $this->UserKpiModel->where('user_id', $userId)->findAll();
        // d($dataLama);
        // die;
        foreach ($dataLama as $row) {
            $this->UserKpiModel->save([
                'id' => $row['id'],
                'evidence' => '',
                'approve' => 'n'
            ]);
            if (!empty($row['evidence'])) {
                if (file_exists('pdf-kpi/' . $row['evidence'])) {
                    unlink('pdf-kpi/' . $row['evidence']);
                }
            }
        }
        session()->setFlashdata('pesanSuccess', 'kpi telah direset');
        return redirect()->to(base_url('/kpi_monitoring/details/' . $userId));
    }
}
