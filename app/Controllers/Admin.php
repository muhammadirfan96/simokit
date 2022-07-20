<?php

namespace App\Controllers;

use App\Models\ChecklistModel;
use App\Models\KwhModel;
use App\Models\LimasModel;
use App\Models\ServiceRequestModel;
use App\Models\UsersKpiModel;
use Myth\Auth\Models\UserModel;

class Admin extends BaseController
{
    protected $KwhModel, $KpiModel, $ChecklistModel, $LimasModel, $ServiceRequestModel, $UserModel;
    public function __construct()
    {
        $this->KwhModel = new KwhModel();
        $this->KpiModel = new UsersKpiModel();
        $this->ChecklistModel = new ChecklistModel();
        $this->LimasModel = new LimasModel();
        $this->ServiceRequestModel = new ServiceRequestModel();
        $this->UserModel = new UserModel();
    }

    public function jmlhChecklistMin($i)
    {
        return count($this->ChecklistModel->where('tanggal <=', date('Y-m-d', strtotime("$i day", strtotime(date('Y-m-d')))))->findAll());
    }
    public function jmlhLimasMin($i)
    {
        return count($this->LimasModel->where('tanggal <=', date('Y-m-d', strtotime("$i day", strtotime(date('Y-m-d')))))->findAll());
    }
    public function jmlhServiceRequestMin($i)
    {
        return count($this->ServiceRequestModel->where('tanggal <=', date('Y-m-d', strtotime("$i day", strtotime(date('Y-m-d')))))->findAll());
    }
    public function jmlhPersonilShift($bidang)
    {
        return count($this->UserModel->asArray()->where('bidang', $bidang)->findAll());
    }

    public function index()
    {
        // kwh

        $totalDataKwh = count($this->KwhModel->findAll());
        $kwh = $this->KwhModel->findAll(5, $totalDataKwh - 5);
        $labels = [];
        $kwhKit1 = [];
        $kwhKit2 = [];
        $kwhPs1 = [];
        $kwhPs2 = [];
        $kwhEt1 = [];
        $kwhEt2 = [];

        foreach ($kwh as $row) {
            $labels[] = $row['waktu'];
            $kwhKit1[] = $row['kit1'];
            $kwhKit2[] = $row['kit2'];
            $kwhPs1[] = $row['ps1'];
            $kwhPs2[] = $row['ps2'];
            $kwhEt1[] = $row['et1'];
            $kwhEt2[] = $row['et2'];
        }

        $dataKwh = [
            $labels,
            $kwhKit1,
            $kwhKit2,
            $kwhPs1,
            $kwhPs2,
            $kwhEt1,
            $kwhEt2,
        ];

        // kpi

        $kpiBelumAdaEvd = $this->KpiModel->where('evidence', '')->findAll();
        $kpiBelumApv = $this->KpiModel->where(['evidence !=' => '', 'approve' => 'n'])->findAll();
        $kpiSudahApv = $this->KpiModel->where(['evidence !=' => '', 'approve' => 'y'])->findAll();
        $jmlhDataKpi = [count($kpiBelumAdaEvd), count($kpiBelumApv), count($kpiSudahApv)];

        // laporan
        $labelLaporan = [];
        for ($i = -9; $i <= 0; $i++) {
            $labelLaporan[] = date('Y-m-d', strtotime("$i day", strtotime(date('Y-m-d'))));
        }

        $jmlhDataChecklist = [
            $this->jmlhChecklistMin(-9),
            $this->jmlhChecklistMin(-8),
            $this->jmlhChecklistMin(-7),
            $this->jmlhChecklistMin(-6),
            $this->jmlhChecklistMin(-5),
            $this->jmlhChecklistMin(-4),
            $this->jmlhChecklistMin(-3),
            $this->jmlhChecklistMin(-2),
            $this->jmlhChecklistMin(-1),
            $this->jmlhChecklistMin(0),
        ];

        $jmlhDataLimas = [
            $this->jmlhLimasMin(-9),
            $this->jmlhLimasMin(-8),
            $this->jmlhLimasMin(-7),
            $this->jmlhLimasMin(-6),
            $this->jmlhLimasMin(-5),
            $this->jmlhLimasMin(-4),
            $this->jmlhLimasMin(-3),
            $this->jmlhLimasMin(-2),
            $this->jmlhLimasMin(-1),
            $this->jmlhLimasMin(0),
        ];

        $jmlhDataServiceRequest = [
            $this->jmlhServiceRequestMin(-9),
            $this->jmlhServiceRequestMin(-8),
            $this->jmlhServiceRequestMin(-7),
            $this->jmlhServiceRequestMin(-6),
            $this->jmlhServiceRequestMin(-5),
            $this->jmlhServiceRequestMin(-4),
            $this->jmlhServiceRequestMin(-3),
            $this->jmlhServiceRequestMin(-2),
            $this->jmlhServiceRequestMin(-1),
            $this->jmlhServiceRequestMin(0),
        ];

        $dataLaporan = [
            $labelLaporan,
            $jmlhDataChecklist,
            $jmlhDataLimas,
            $jmlhDataServiceRequest
        ];

        // d($dataLaporan);

        // users
        $jmlhDataUsers = [
            $this->jmlhPersonilShift('operator shift a'),
            $this->jmlhPersonilShift('operator shift b'),
            $this->jmlhPersonilShift('operator shift c'),
            $this->jmlhPersonilShift('operator shift d'),
        ];

        $data = [
            'title' => 'admin | home',
            'dataKwh' => $dataKwh,
            'jmlhDataKpi' => $jmlhDataKpi,
            'dataLaporan' => $dataLaporan,
            'jmlhDataUsers' => $jmlhDataUsers,
        ];

        return view('admin/index', $data);
    }
}
