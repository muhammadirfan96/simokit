<?php

namespace App\Controllers;

use App\Models\LimasBoilerPertamaModel;
use App\Models\LimasBoilerKeduaModel;
use App\Models\LimasBoilerKetigaModel;
use App\Models\LimasTurbinPertamaModel;
use App\Models\LimasTurbinKeduaModel;
use App\Models\LimasTurbinKetigaModel;
use App\Models\LimasTurbinKeempatModel;
use App\Models\LimasAlbaPertamaModel;
use App\Models\LimasAlbaKeduaModel;
use App\Models\ScheduleSatuModel;
use App\Models\ScheduleDuaModel;
use App\Models\ScheduleCommonModel;

class Home extends BaseController
{
    protected $scheduleSatu, $scheduleDua, $scheduleCommon, $limasBoilerPertama, $limasBoilerKedua, $limasBoilerKetiga, $limasTurbinPertama, $limasTurbinKedua, $limasTurbinKetiga, $limasTurbinKeempat, $limasAlbaPertama, $limasAlbaKedua;

    public function __construct()
    {
        $this->scheduleSatu = new ScheduleSatuModel();
        $this->scheduleDua = new ScheduleDuaModel();
        $this->scheduleCommon = new ScheduleCommonModel();
        $this->limasBoilerPertama = new LimasBoilerPertamaModel();
        $this->limasBoilerKedua = new LimasBoilerKeduaModel();
        $this->limasBoilerKetiga = new LimasBoilerKetigaModel();
        $this->limasTurbinPertama = new LimasTurbinPertamaModel();
        $this->limasTurbinKedua = new LimasTurbinKeduaModel();
        $this->limasTurbinKetiga = new LimasTurbinKetigaModel();
        $this->limasTurbinKeempat = new LimasTurbinKeempatModel();
        $this->limasAlbaPertama = new LimasAlbaPertamaModel();
        $this->limasAlbaKedua = new LimasAlbaKeduaModel();
    }

    public function index()
    {
        $limasBoiler = [
            $this->limasBoilerPertama->limasBoilerPertama(),
            $this->limasBoilerKedua->limasBoilerKedua(),
            $this->limasBoilerKetiga->limasBoilerKetiga()
        ];

        $limasTurbin = [
            $this->limasTurbinPertama->limasTurbinPertama(),
            $this->limasTurbinKedua->limasTurbinKedua(),
            $this->limasTurbinKetiga->limasTurbinKetiga(),
            $this->limasTurbinKeempat->limasTurbinKeempat(),
        ];

        $limasAlba = [
            $this->limasAlbaPertama->limasAlbaPertama(),
            $this->limasAlbaKedua->limasAlbaKedua()
        ];

        $data = [
            'title' => 'home | simokit',
            'limasBoiler' => $limasBoiler,
            'limasTurbin' => $limasTurbin,
            'limasAlba' => $limasAlba,
            'jadwalCoUnit1' => $this->scheduleSatu->scheduleSatu(),
            'jadwalCoUnit2' => $this->scheduleDua->scheduleDua(),
            'jadwalCoCommon' => $this->scheduleCommon->scheduleCommon()
        ];

        return view('home/index', $data);
    }
}
