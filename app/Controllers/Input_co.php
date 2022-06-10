<?php

namespace App\Controllers;

use App\Models\ScheduleSatuModel;
use App\Models\ScheduleDuaModel;
use App\Models\ScheduleCommonModel;

class Input_co extends BaseController
{
    protected $scheduleSatuModel, $scheduleDuaModel, $scheduleCommonModel, $hari;

    public function __construct()
    {
        $this->scheduleSatuModel = new ScheduleSatuModel();
        $this->scheduleDuaModel = new ScheduleDuaModel();
        $this->scheduleCommonModel = new ScheduleCommonModel();

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

    public function index()
    {
        // d($scheduleID);
        // dd($scheduleFix);
        $key = $this->scheduleSatuModel->getFieldNames('schedulesatu');
        $data = [
            'title' => 'input | co',
            'hari' => $this->hari,
            'tools' => $this->scheduleSatuModel->tools,
            'bagian' => 'unit#1',
            'schedule' => $this->scheduleSatuModel->scheduleSatuFix(),
            'key' => $key
        ];

        // dd($schedule[0][$key[3]]);
        // dd($schedule);
        // $schedule[$i - 1][$key[$j - 97]] == 'ya' ? 'checked' : '';

        return view('input_co/index', $data);
    }

    public function tablesatu()
    {
        $data = [
            'hari' => $this->hari,
            'tools' => $this->scheduleSatuModel->tools,
            'bagian' => 'unit#1',
            'schedule' => $this->scheduleSatuModel->scheduleSatuFix(),
            'key' => $this->scheduleSatuModel->getFieldNames('schedulesatu')
        ];
        // dd($data);
        return view('input_co/table', $data);
    }

    public function tabledua()
    {

        $data = [
            'hari' => $this->hari,
            'tools' => $this->scheduleDuaModel->tools,
            'bagian' => 'unit#2',
            'schedule' => $this->scheduleDuaModel->scheduleDuaFix(),
            'key' => $this->scheduleDuaModel->getFieldNames('scheduledua')
        ];
        // dd($data);
        return view('input_co/table', $data);
    }

    public function tablecommon()
    {
        $data = [
            'hari' => $this->hari,
            'tools' => $this->scheduleCommonModel->tools,
            'bagian' => 'common',
            'schedule' => $this->scheduleCommonModel->scheduleCommonFix(),
            'key' => $this->scheduleCommonModel->getFieldNames('schedulecommon')
        ];
        // dd($data);
        return view('input_co/table', $data);
    }

    public function simpan()
    {
        if ($this->request->getVar('unit#1') == "v") {
            $key = $this->scheduleSatuModel->getFieldNames('schedulesatu');
            $this->scheduleSatuModel->setAllowedFields($key);
            // $this->scheduleSatuModel->truncate('schedulesatu');
            // $schedule[$i - 1][$key[$j - 97]] == 'ya' ? 'checked' : '';
            for ($i = 1; $i <= 31; $i++) {
                $value = [''];
                $value[] = date('Y-m-' . $i);
                for ($j = 99; $j <= 123; $j++) {
                    if ($this->request->getVar("$i" . "$j") == null) {
                        $value[] = "";
                    } else {
                        $value[] = $this->request->getVar("$i" . "$j");
                    }
                }
                $result = array_combine($key, $value);
                // d($result);

                $this->scheduleSatuModel->save($result);
            }
            // die;
            session()->setFlashdata('pesanSuccess', 'jadwal change over unit 1 telah di update !');
        }
        if ($this->request->getVar('unit#2') == "v") {
            $key = $this->scheduleDuaModel->getFieldNames('scheduledua');
            $this->scheduleDuaModel->setAllowedFields($key);
            // $this->scheduleDuaModel->truncate('scheduledua');
            for ($i = 1; $i <= 31; $i++) {
                $value = [''];
                $value[] = date('Y-m-' . $i);
                for ($j = 99; $j <= 123; $j++) {
                    if ($this->request->getVar("$i" . "$j") == null) {
                        $value[] = "";
                    } else {
                        $value[] = $this->request->getVar("$i" . "$j");
                    }
                }
                $result = array_combine($key, $value);
                // d($result);

                $this->scheduleDuaModel->save($result);
            }
            session()->setFlashdata('pesanSuccess', 'jadwal change over unit 2 telah di update !');
        }
        if ($this->request->getVar('common') == "v") {
            $key = $this->scheduleCommonModel->getFieldNames('schedulecommon');
            $this->scheduleCommonModel->setAllowedFields($key);
            // $this->scheduleCommonModel->truncate('schedulecommon');
            for ($i = 1; $i <= 31; $i++) {
                $value = [''];
                $value[] = date('Y-m-' . $i);
                for ($j = 99; $j <= 112; $j++) {
                    if ($this->request->getVar("$i" . "$j") == null) {
                        $value[] = "";
                    } else {
                        $value[] = $this->request->getVar("$i" . "$j");
                    }
                }
                $result = array_combine($key, $value);
                // d($result);

                $this->scheduleCommonModel->save($result);
            }
            session()->setFlashdata('pesanSuccess', 'jadwal change over common telah di update !');
        }
        return redirect()->to(base_url('/input_co'));
    }
}
