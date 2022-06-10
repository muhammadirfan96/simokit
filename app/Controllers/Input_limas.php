<?php

namespace App\Controllers;

use App\Models\LimasBoilerKeduaModel;
use App\Models\LimasBoilerKetigaModel;
use App\Models\LimasBoilerPertamaModel;
use App\Models\LimasTurbinPertamaModel;
use App\Models\LimasTurbinKeduaModel;
use App\Models\LimasTurbinKetigaModel;
use App\Models\LimasTurbinKeempatModel;
use App\Models\LimasAlbaPertamaModel;
use App\Models\LimasAlbaKeduaModel;

class Input_limas extends BaseController
{
    protected $limasBoilerPertamaModel, $limasBoilerKeduaModel, $limasBoilerKetigaModel, $limasTurbinPertamaModel, $limasTurbinKeduaModel, $limasTurbinKetigaModel, $limasTurbinKeempatModel, $limasAlbaPertamaModel, $limasAlbaKeduaModel, $tablesboiler, $scheduleBoiler, $keyBoiler, $tablesTurbin, $scheduleTurbin, $keyTurbin, $tablesAlba, $scheduleAlba, $keyAlba, $hari;

    public function __construct()
    {
        $this->limasBoilerPertamaModel = new LimasBoilerPertamaModel();
        $this->limasBoilerKeduaModel = new LimasBoilerKeduaModel();
        $this->limasBoilerKetigaModel = new LimasBoilerKetigaModel();
        $this->limasTurbinPertamaModel = new LimasTurbinPertamaModel();
        $this->limasTurbinKeduaModel = new LimasTurbinKeduaModel();
        $this->limasTurbinKetigaModel = new LimasTurbinKetigaModel();
        $this->limasTurbinKeempatModel = new LimasTurbinKeempatModel();
        $this->limasAlbaPertamaModel = new LimasAlbaPertamaModel();
        $this->limasAlbaKeduaModel = new LimasAlbaKeduaModel();

        //boiler
        $this->tablesBoiler = [
            $this->limasBoilerPertamaModel->peralatanBoilerPertama, $this->limasBoilerKeduaModel->peralatanBoilerKedua, $this->limasBoilerKetigaModel->peralatanBoilerKetiga
        ];

        $this->scheduleBoiler = [
            $this->limasBoilerPertamaModel->limasBoilerPertamaFix(),
            $this->limasBoilerKeduaModel->limasBoilerKeduaFix(),
            $this->limasBoilerKetigaModel->limasBoilerKetigaFix()
        ];

        $this->keyBoiler = [
            $this->limasBoilerPertamaModel->getFieldNames('limasboilerpertama'),
            $this->limasBoilerKeduaModel->getFieldNames('limasboilerkedua'),
            $this->limasBoilerKetigaModel->getFieldNames('limasboilerketiga')
        ];

        // turbin
        $this->tablesTurbin = [
            $this->limasTurbinPertamaModel->peralatanTurbinPertama, $this->limasTurbinKeduaModel->peralatanTurbinKedua, $this->limasTurbinKetigaModel->peralatanTurbinKetiga, $this->limasTurbinKeempatModel->peralatanTurbinKeempat
        ];

        $this->scheduleTurbin = [
            $this->limasTurbinPertamaModel->limasTurbinPertamaFix(),
            $this->limasTurbinKeduaModel->limasTurbinKeduaFix(),
            $this->limasTurbinKetigaModel->limasTurbinKetigaFix(),
            $this->limasTurbinKeempatModel->limasTurbinKeempatFix()
        ];

        $this->keyTurbin = [
            $this->limasTurbinPertamaModel->getFieldNames('limasturbinpertama'),
            $this->limasTurbinKeduaModel->getFieldNames('limasturbinkedua'),
            $this->limasTurbinKetigaModel->getFieldNames('limasturbinketiga'),
            $this->limasTurbinKeempatModel->getFieldNames('limasturbinkeempat')
        ];

        //alba
        $this->tablesAlba = [
            $this->limasAlbaPertamaModel->peralatanAlbaPertama,
            $this->limasAlbaKeduaModel->peralatanAlbaKedua
        ];

        $this->scheduleAlba = [
            $this->limasAlbaPertamaModel->limasAlbaPertamaFix(),
            $this->limasAlbaKeduaModel->limasAlbaKeduaFix()
        ];

        $this->keyAlba = [
            $this->limasAlbaPertamaModel->getFieldNames('limasalbapertama'),
            $this->limasAlbaKeduaModel->getFieldNames('limasalbakedua')
        ];

        $bln30 = ["04", "06", "09", "11"];
        $bln = date('m');
        if (in_array($bln, $bln30)) {
            $this->hari = 30;
        } elseif ($bln == "02") {
            if (date('Y') % 4 === 0) {
                $this->hari = 29;
            } else {
                $this->hari = 28;
            }
        } else {
            $this->hari = 31;
        }
    }
    //  $schedule[$k - 1][$i - 1][$key[$k - 1][$j - 97]] == 'ya' ? 'checked' : ''

    public function index()
    {
        $data = [
            'title' => 'input | kegiatan 5s',
            'hari' => $this->hari,
            'tables' => $this->tablesBoiler,
            'bagian' => 'boiler',
            'schedule' => $this->scheduleBoiler,
            'key' => $this->keyBoiler
        ];

        return view('input_limas/index', $data);
    }

    public function boiler()
    {
        $data = [
            'hari' => $this->hari,
            'tables' => $this->tablesBoiler,
            'bagian' => 'boiler',
            'schedule' => $this->scheduleBoiler,
            'key' => $this->keyBoiler
        ];
        // dd($data);

        return view('input_limas/table', $data);
    }

    public function turbin()
    {
        $data = [
            'hari' => $this->hari,
            'tables' => $this->tablesTurbin,
            'bagian' => 'turbin',
            'schedule' => $this->scheduleTurbin,
            'key' => $this->keyTurbin
        ];
        // dd($data);

        return view('input_limas/table', $data);
    }

    public function alba()
    {
        $data = [
            'hari' => $this->hari,
            'tables' => $this->tablesAlba,
            'bagian' => 'alba',
            'schedule' => $this->scheduleAlba,
            'key' => $this->keyAlba
        ];
        // dd($data);

        return view('input_limas/table', $data);
    }

    public function simpan()
    {
        if ($this->request->getVar('boiler') == "v") {
            // dd($this->request->getVar());
            $key1 = $this->limasBoilerPertamaModel->getFieldNames('limasboilerpertama');
            $this->limasBoilerPertamaModel->setAllowedFields($key1);
            // $this->limasBoilerPertamaModel->truncate('limasboilerpertama');
            for ($i = 1; $i <= 31; $i++) {
                $value1 = [''];
                $value1[] = date('Y-m-' . $i);
                for ($j = 99; $j <= 124; $j++) {
                    if ($this->request->getVar("$i" . "$j" . "1") == null) {
                        $value1[] = "";
                    } else {
                        $value1[] = $this->request->getVar("$i" . "$j" . "1");
                    }
                }
                $result = array_combine($key1, $value1);
                // d($result);

                $this->limasBoilerPertamaModel->save($result);
            }
            $key2 = $this->limasBoilerKeduaModel->getFieldNames('limasboilerkedua');
            $this->limasBoilerKeduaModel->setAllowedFields($key2);
            // $this->limasBoilerKeduaModel->truncate('limasboilerkedua');
            for ($i = 1; $i <= 31; $i++) {
                $value2 = [''];
                $value2[] = date('Y-m-' . $i);
                for ($j = 99; $j <= 124; $j++) {
                    if ($this->request->getVar("$i" . "$j" . "2") == null) {
                        $value2[] = "";
                    } else {
                        $value2[] = $this->request->getVar("$i" . "$j" . "2");
                    }
                }
                $result = array_combine($key2, $value2);
                // d($result);

                $this->limasBoilerKeduaModel->save($result);
            }
            $key3 = $this->limasBoilerKetigaModel->getFieldNames('limasboilerketiga');
            $this->limasBoilerKetigaModel->setAllowedFields($key3);
            // $this->limasBoilerKetigaModel->truncate('limasboilerketiga');
            for ($i = 1; $i <= 31; $i++) {
                $value3 = [''];
                $value3[] = date('Y-m-' . $i);
                for ($j = 99; $j <= 118; $j++) {
                    if ($this->request->getVar("$i" . "$j" . "3") == null) {
                        $value3[] = "";
                    } else {
                        $value3[] = $this->request->getVar("$i" . "$j" . "3");
                    }
                }
                $result = array_combine($key3, $value3);
                // d($result);

                $this->limasBoilerKetigaModel->save($result);
            }
            session()->setFlashdata('pesanSuccess', 'jadwal kegiatan 5s boiler berhasil di update !');
        }
        if ($this->request->getVar('turbin') == "v") {
            // dd($this->request->getVar());
            $key1 = $this->limasTurbinPertamaModel->getFieldNames('limasturbinpertama');
            $this->limasTurbinPertamaModel->setAllowedFields($key1);
            // $this->limasTurbinPertamaModel->truncate('limasturbinpertama');
            for ($i = 1; $i <= 31; $i++) {
                $value1 = [''];
                $value1[] = date('Y-m-' . $i);
                for ($j = 99; $j <= 126; $j++) {
                    if ($this->request->getVar("$i" . "$j" . "1") == null) {
                        $value1[] = "";
                    } else {
                        $value1[] = $this->request->getVar("$i" . "$j" . "1");
                    }
                }
                $result = array_combine($key1, $value1);
                // d($result);

                $this->limasTurbinPertamaModel->save($result);
            }

            $key2 = $this->limasTurbinKeduaModel->getFieldNames('limasturbinkedua');
            $this->limasTurbinKeduaModel->setAllowedFields($key2);
            // $this->limasTurbinKeduaModel->truncate('limasturbinkedua');
            for ($i = 1; $i <= 31; $i++) {
                $value2 = [''];
                $value2[] = date('Y-m-' . $i);
                for ($j = 99; $j <= 126; $j++) {
                    if ($this->request->getVar("$i" . "$j" . "2") == null) {
                        $value2[] = "";
                    } else {
                        $value2[] = $this->request->getVar("$i" . "$j" . "2");
                    }
                }
                $result = array_combine($key2, $value2);

                $this->limasTurbinKeduaModel->save($result);
            }

            $key3 = $this->limasTurbinKetigaModel->getFieldNames('limasturbinketiga');
            $this->limasTurbinKetigaModel->setAllowedFields($key3);
            // $this->limasTurbinKetigaModel->truncate('limasturbinketiga');
            for ($i = 1; $i <= 31; $i++) {
                $value3 = [''];
                $value3[] = date('Y-m-' . $i);
                for ($j = 99; $j <= 124; $j++) {
                    if ($this->request->getVar("$i" . "$j" . "3") == null) {
                        $value3[] = "";
                    } else {
                        $value3[] = $this->request->getVar("$i" . "$j" . "3");
                    }
                }
                $result = array_combine($key3, $value3);

                $this->limasTurbinKetigaModel->save($result);
            }

            $key4 = $this->limasTurbinKeempatModel->getFieldNames('limasturbinkeempat');
            $this->limasTurbinKeempatModel->setAllowedFields($key4);
            // $this->limasTurbinKeempatModel->truncate('limasturbinkeempat');
            for ($i = 1; $i <= 31; $i++) {
                $value4 = [''];
                $value4[] = date('Y-m-' . $i);
                for ($j = 99; $j <= 122; $j++) {
                    if ($this->request->getVar("$i" . "$j" . "4") == null) {
                        $value4[] = "";
                    } else {
                        $value4[] = $this->request->getVar("$i" . "$j" . "4");
                    }
                }
                $result = array_combine($key4, $value4);

                $this->limasTurbinKeempatModel->save($result);
            }
            session()->setFlashdata('pesanSuccess', 'jadwal kegiatan 5s turbin berhasil di update !');
        }
        if ($this->request->getVar('alba') == "v") {
            // dd($this->request->getVar());
            $key1 = $this->limasAlbaPertamaModel->getFieldNames('limasalbapertama');
            $this->limasAlbaPertamaModel->setAllowedFields($key1);
            // $this->limasAlbaPertamaModel->truncate('limasalbapertama');
            for ($i = 1; $i <= 31; $i++) {
                $value1 = [''];
                $value1[] = date('Y-m-' . $i);
                for ($j = 99; $j <= 126; $j++) {
                    if ($this->request->getVar("$i" . "$j" . "1") == null) {
                        $value1[] = "";
                    } else {
                        $value1[] = $this->request->getVar("$i" . "$j" . "1");
                    }
                }
                $result = array_combine($key1, $value1);

                $this->limasAlbaPertamaModel->save($result);
            }

            $key2 = $this->limasAlbaKeduaModel->getFieldNames('limasalbakedua');
            $this->limasAlbaKeduaModel->setAllowedFields($key2);
            // $this->limasAlbaKeduaModel->truncate('limasalbakedua');
            for ($i = 1; $i <= 31; $i++) {
                $value2 = [''];
                $value2[] = date('Y-m-' . $i);
                for ($j = 99; $j <= 106; $j++) {
                    if ($this->request->getVar("$i" . "$j" . "2") == null) {
                        $value2[] = "";
                    } else {
                        $value2[] = $this->request->getVar("$i" . "$j" . "2");
                    }
                }
                $result = array_combine($key2, $value2);

                $this->limasAlbaKeduaModel->save($result);
            }
            session()->setFlashdata('pesanSuccess', 'jadwal kegiatan 5s alba berhasil di update !');
        }
        return redirect()->to(base_url('/input_limas'));
    }
}
