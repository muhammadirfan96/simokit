<?php

namespace App\Controllers;

use App\Models\ListOfKpiModel;
use App\Models\UsersKpiModel;

class Kpi extends BaseController
{
    protected $ListOfKpiModel, $UserKpiModel, $db;
    public function __construct()
    {
        $this->ListOfKpiModel = new ListOfKpiModel();
        $this->UserKpiModel = new UsersKpiModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $builder = $this->db->table('list_of_kpi');
        $builder->where('users_kpi.user_id', user_id());
        $builder->join('users_kpi', 'list_of_kpi.id = users_kpi.kpi_id');
        $join = $builder->get()->getResult('array');

        $data = [
            'title' => 'key performance indicator',
            'kpiUser' => $join,
        ];

        return view('kpi/index', $data);
    }

    public function upload($kpiId)
    {
        $dataLama = $this->UserKpiModel->find($kpiId);
        if ($dataLama == null) {
            session()->setFlashdata('pesanWarning', 'kpi tidak ditemukan');
            return redirect()->to(base_url('/kpi'));
        }
        if (!empty($dataLama['evidence'])) {
            if (file_exists('pdf-kpi/' . $dataLama['evidence'])) {
                unlink('pdf-kpi/' . $dataLama['evidence']);
            }
        }

        $file = $this->request->getFile($kpiId);
        $namaFile = $file->getRandomName();

        $this->UserKpiModel->save([
            'id' => $kpiId,
            'evidence' => $namaFile
        ]);

        $file->move('pdf-kpi', $namaFile);

        session()->setFlashdata('pesanSuccess', 'evidence kpi telah ditambahkan');
        return redirect()->to(base_url('/kpi'));
    }

    public function download($nama)
    {
        if (!file_exists('pdf-kpi/' . $nama)) {
            session()->setFlashdata('pesanWarning', 'file evidence kpi tidak ditemukan');
            return redirect()->back();
        }
        $randomString = time();
        return $this->response->download('pdf-kpi/' . $nama, null)->setFileName('simokit-' . $randomString . '.pdf');
    }
}
