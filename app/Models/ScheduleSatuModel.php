<?php

namespace App\Models;

use CodeIgniter\Model;

class ScheduleSatuModel extends Model
{
    protected $table      = 'schedulesatu';
    protected $primaryKey = 'id';
    protected $allowedFields = [];
    protected $tools = [
        "cwp c booster pump a",
        "cwp c booster pump b",
        "cwp d booster pump a",
        "cwp d booster pump b",
        "ccwp 1a",
        "ccwp 1b",
        "cep 1a",
        "cep 1b",
        "vacuum pump 1a",
        "vacuum pump 1b",
        "bfp 1a",
        "bfp 1b",
        "bfp 1c",
        "eh oil pump 1a",
        "eh oil pump 1b",
        "gland seal fan 1a",
        "gland seal fan 1b",
        "hpff 1a",
        "hpff 1b",
        "hpff 1c",
        "oge fan 1a",
        "oge fan 1b",
        "cooling fan 1a",
        "cooling fan 1b",
        "ball cleaning #1"
    ];

    public function scheduleSatuFix()
    {
        $schedule = $this->orderBy('id', 'desc')->findAll(31, 0);
        $scheduleID = [];
        foreach ($schedule as $row) {
            $scheduleID[] = $row['id'];
        }
        asort($scheduleID);
        $scheduleSatuFix = [];
        foreach ($scheduleID as $fix) {
            $scheduleSatuFix[] = $this->find($fix);
        }

        return $scheduleSatuFix;
    }

    public function scheduleSatu()
    {
        $jadwalCoUnit1 = [];
        if ($this->where(['tanggal' => date('Y-m-d')])->orderBy('id', 'desc')->first() == null) {
            $jadwalCoUnit1[] = "data belum diinput";
        } elseif ($this->where(['tanggal' => date('Y-m-d', strtotime("-1 day", strtotime(date('Y-m-d'))))])->orderBy('id', 'desc')->first() == null) {
            $jadwalCoUnit1[] = "data belum belum dapat ditampilkan";
        } else {
            $hariIniUnit1 = $this->where(['tanggal' => date('Y-m-d')])->orderBy('id', 'desc')->first();
            $kemarinUnit1 = $this->where(['tanggal' => date('Y-m-d', strtotime("-1 day", strtotime(date('Y-m-d'))))])->orderBy('id', 'desc')->first();

            //cwp c booster pump
            if ($hariIniUnit1["cwpcboosterpumpa"] !== $kemarinUnit1["cwpcboosterpumpa"] || $hariIniUnit1["cwpcboosterpumpb"] !== $kemarinUnit1["cwpcboosterpumpb"]) {
                $cwpc = "change over";
                if (!empty($hariIniUnit1["cwpcboosterpumpa"])) {
                    $cwpc .= " CWP C BOOSTER PUMP B ke A";
                } else {
                    $cwpc .= " CWP C BOOSTER PUMP A ke B";
                }
                $jadwalCoUnit1[] = $cwpc;
            }

            //cwp d booster pump
            if ($hariIniUnit1["cwpdboosterpumpa"] !== $kemarinUnit1["cwpdboosterpumpa"] || $hariIniUnit1["cwpdboosterpumpb"] !== $kemarinUnit1["cwpdboosterpumpb"]) {
                $cwpd = "change over";
                if (!empty($hariIniUnit1["cwpdboosterpumpa"])) {
                    $cwpd .= " CWP D BOOSTER PUMP B ke A";
                } else {
                    $cwpd .= " CWP D BOOSTER PUMP A ke B";
                }
                $jadwalCoUnit1[] = $cwpd;
            }

            //ccwp
            if ($hariIniUnit1["ccwp1a"] !== $kemarinUnit1["ccwp1a"] || $hariIniUnit1["ccwp1b"] !== $kemarinUnit1["ccwp1b"]) {
                $ccwp1 = "change over";
                if (!empty($hariIniUnit1["ccwp1a"])) {
                    $ccwp1 .= " CCWP 1 B ke A";
                } else {
                    $ccwp1 .= " CCWP 1 A ke B";
                }
                $jadwalCoUnit1[] = $ccwp1;
            }

            //cep
            if ($hariIniUnit1["cep1a"] !== $kemarinUnit1["cep1a"] || $hariIniUnit1["cep1b"] !== $kemarinUnit1["cep1b"]) {
                $cep1 = "change over";
                if (!empty($hariIniUnit1["cep1a"])) {
                    $cep1 .= " CEP 1 B ke A";
                } else {
                    $cep1 .= " CEP 1 A ke B";
                }
                $jadwalCoUnit1[] = $cep1;
            }

            // vacum
            if ($hariIniUnit1["vacuumpump1a"] !== $kemarinUnit1["vacuumpump1a"] || $hariIniUnit1["vacuumpump1b"] !== $kemarinUnit1["vacuumpump1b"]) {
                $vacuum1 = "change over";
                if (!empty($hariIniUnit1["vacuumpump1a"])) {
                    $vacuum1 .= " VACUUM PUMP 1 B ke A";
                } else {
                    $vacuum1 .= " VACUUM PUMP 1 A ke B";
                }
                $jadwalCoUnit1[] = $vacuum1;
            }

            // bfp
            if ($hariIniUnit1["bfp1a"] !== $kemarinUnit1["bfp1a"] || $hariIniUnit1["bfp1b"] !== $kemarinUnit1["bfp1b"] || $hariIniUnit1["bfp1c"] !== $kemarinUnit1["bfp1c"]) {
                $bfp1 = "change over";
                if ($hariIniUnit1["bfp1a"] === $kemarinUnit1["bfp1a"]) {
                    if (!empty($hariIniUnit1["bfp1b"])) {
                        $bfp1 .= " FEED WATER PUMP 1 C ke B";
                    } else {
                        $bfp1 .= " FEED WATER PUMP 1 B ke C";
                    }
                }

                if ($hariIniUnit1["bfp1b"] === $kemarinUnit1["bfp1b"]) {
                    if (!empty($hariIniUnit1["bfp1a"])) {
                        $bfp1 .= " FEED WATER PUMP 1 C ke A";
                    } else {
                        $bfp1 .= " FEED WATER PUMP 1 A ke C";
                    }
                }

                if ($hariIniUnit1["bfp1c"] === $kemarinUnit1["bfp1c"]) {
                    if (!empty($hariIniUnit1["bfp1a"])) {
                        $bfp1 .= " FEED WATER PUMP 1 B ke A";
                    } else {
                        $bfp1 .= " FEED WATER PUMP 1 A ke B";
                    }
                }
                $jadwalCoUnit1[] = $bfp1;
            }

            // eh oil
            if (!empty($hariIniUnit1["ehoilpump1a"]) && !empty($kemarinUnit1["ehoilpump1a"])) {
                if (!empty($hariIniUnit1["ehoilpump1b"])) {
                    $ehoilpump1 = "WARMING UP EH OIL PUMP 1 B";
                    $jadwalCoUnit1[] = $ehoilpump1;
                }
            } elseif (!empty($hariIniUnit1["ehoilpump1b"]) && !empty($kemarinUnit1["ehoilpump1b"])) {
                if (!empty($hariIniUnit1["ehoilpump1a"])) {
                    $ehoilpump1 = "WARMING UP EH OIL PUMP 1 A";
                    $jadwalCoUnit1[] = $ehoilpump1;
                }
            }

            // gland seal fan
            if ($hariIniUnit1["glandsealfan1a"] !== $kemarinUnit1["glandsealfan1a"] || $hariIniUnit1["glandsealfan1b"] !== $kemarinUnit1["glandsealfan1b"]) {
                $glandsealfan1 = "change over";
                if (!empty($hariIniUnit1["glandsealfan1a"])) {
                    $glandsealfan1 .= " GLAND SEAL FAN 1 B ke A";
                } else {
                    $glandsealfan1 .= " GLAND SEAL FAN 1 A ke B";
                }
                $jadwalCoUnit1[] = $glandsealfan1;
            }

            // hpff
            if ($hariIniUnit1["hpff1a"] !== $kemarinUnit1["hpff1a"] || $hariIniUnit1["hpff1b"] !== $kemarinUnit1["hpff1b"] || $hariIniUnit1["hpff1c"] !== $kemarinUnit1["hpff1c"]) {
                $hpff1 = "change over";
                if ($hariIniUnit1["hpff1a"] === $kemarinUnit1["hpff1a"]) {
                    if (!empty($hariIniUnit1["hpff1b"])) {
                        $hpff1 .= " HPFF 1 C ke B";
                    } else {
                        $hpff1 .= " HPFF 1 B ke C";
                    }
                }

                if ($hariIniUnit1["hpff1b"] === $kemarinUnit1["hpff1b"]) {
                    if (!empty($hariIniUnit1["hpff1a"])) {
                        $hpff1 .= " HPFF 1 C ke A";
                    } else {
                        $hpff1 .= " HPFF 1 A ke C";
                    }
                }

                if ($hariIniUnit1["hpff1c"] === $kemarinUnit1["hpff1c"]) {
                    if (!empty($hariIniUnit1["hpff1a"])) {
                        $hpff1 .= " HPFF 1 B ke A";
                    } else {
                        $hpff1 .= " HPFF 1 A ke B";
                    }
                }
                $jadwalCoUnit1[] = $hpff1;
            }

            // oge fan
            if ($hariIniUnit1["ogefan1a"] !== $kemarinUnit1["ogefan1a"] || $hariIniUnit1["ogefan1b"] !== $kemarinUnit1["ogefan1b"]) {
                $ogefan1 = "change over";
                if (!empty($hariIniUnit1["ogefan1a"])) {
                    $ogefan1 .= " OIL GAS EXTRACTOR FAN 1 B ke A";
                } else {
                    $ogefan1 .= " OIL GAS EXTRACTOR FAN 1 A ke B";
                }
                $jadwalCoUnit1[] = $ogefan1;
            }

            // cool fan
            if ($hariIniUnit1["coolingfan1a"] !== $kemarinUnit1["coolingfan1a"] || $hariIniUnit1["coolingfan1b"] !== $kemarinUnit1["coolingfan1b"]) {
                $coolingfan1 = "change over";
                if (!empty($hariIniUnit1["coolingfan1a"])) {
                    $coolingfan1 .= " COOLING FAN 1 B ke A";
                } else {
                    $coolingfan1 .= " COOLING FAN 1 A ke B";
                }
                $jadwalCoUnit1[] = $coolingfan1;
            }

            // ball cleaning
            if (!empty($hariIniUnit1["ballcleaning1"])) {
                $jadwalCoUnit1[] = "PENGOPERASIAN BALL CLEANING #1";
            }
        }
        return $jadwalCoUnit1;
    }
}
