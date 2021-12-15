<?php

namespace App\Models;

use CodeIgniter\Model;

class ScheduleDuaModel extends Model
{
    protected $table      = 'scheduledua';
    protected $primaryKey = 'id';
    protected $allowedFields = [];
    protected $tools = [
        "cwp a booster pump a",
        "cwp a booster pump b",
        "cwp b booster pump a",
        "cwp b booster pump b",
        "ccwp 2a",
        "ccwp 2b",
        "cep 2a",
        "cep 2b",
        "vacuum pump 2a",
        "vacuum pump 2b",
        "bfp 2a",
        "bfp 2b",
        "bfp 2c",
        "eh oil pump 2a",
        "eh oil pump 2b",
        "gland seal fan 2a",
        "gland seal fan 2b",
        "hpff 2a",
        "hpff 2b",
        "hpff 2c",
        "oge fan 2a",
        "oge fan 2b",
        "cooling fan 2a",
        "cooling fan 2b",
        "ball cleaning #2"
    ];

    public function scheduleDua()
    {

        $jadwalCoUnit2 = [];
        if ($this->where(['tanggal' => date('Y-m-d')])->orderBy('id', 'desc')->first() == null) {
            $jadwalCoUnit2[] = "data belum diinput";
        } else {
            $hariIniUnit2 = $this->where(['tanggal' => date('Y-m-d')])->orderBy('id', 'desc')->first();
            $kemarinUnit2 = $this->where(['tanggal' => date('Y-m-d', strtotime("-1 day", strtotime(date('Y-m-d'))))])->orderBy('id', 'desc')->first();

            //cwp a booster pump
            if ($hariIniUnit2["cwpaboosterpumpa"] !== $kemarinUnit2["cwpaboosterpumpa"] || $hariIniUnit2["cwpaboosterpumpb"] !== $kemarinUnit2["cwpaboosterpumpb"]) {
                $cwpa = "change over";
                if (!empty($hariIniUnit2["cwpaboosterpumpa"])) {
                    $cwpa .= " CWP A BOOSTER PUMP B ke A";
                } else {
                    $cwpa .= " CWP A BOOSTER PUMP A ke B";
                }
                $jadwalCoUnit2[] = $cwpa;
            }

            //cwp b booster pump
            if ($hariIniUnit2["cwpbboosterpumpa"] !== $kemarinUnit2["cwpbboosterpumpa"] || $hariIniUnit2["cwpbboosterpumpb"] !== $kemarinUnit2["cwpbboosterpumpb"]) {
                $cwpb = "change over";
                if (!empty($hariIniUnit2["cwpbboosterpumpa"])) {
                    $cwpb .= " CWP B BOOSTER PUMP B ke A";
                } else {
                    $cwpb .= " CWP B BOOSTER PUMP A ke B";
                }
                $jadwalCoUnit2[] = $cwpb;
            }

            //ccwp
            if ($hariIniUnit2["ccwp2a"] !== $kemarinUnit2["ccwp2a"] || $hariIniUnit2["ccwp2b"] !== $kemarinUnit2["ccwp2b"]) {
                $ccwp2 = "change over";
                if (!empty($hariIniUnit2["ccwp2a"])) {
                    $ccwp2 .= " CCWP 2 B ke A";
                } else {
                    $ccwp2 .= " CCWP 2 A ke B";
                }
                $jadwalCoUnit2[] = $ccwp2;
            }

            //cep
            if ($hariIniUnit2["cep2a"] !== $kemarinUnit2["cep2a"] || $hariIniUnit2["cep2b"] !== $kemarinUnit2["cep2b"]) {
                $cep2 = "change over";
                if (!empty($hariIniUnit2["cep2a"])) {
                    $cep2 .= " CEP 2 B ke A";
                } else {
                    $cep2 .= " CEP 2 A ke B";
                }
                $jadwalCoUnit2[] = $cep2;
            }

            // vacum
            if ($hariIniUnit2["vacuumpump2a"] !== $kemarinUnit2["vacuumpump2a"] || $hariIniUnit2["vacuumpump2b"] !== $kemarinUnit2["vacuumpump2b"]) {
                $vacuum2 = "change over";
                if (!empty($hariIniUnit2["vacuumpump2a"])) {
                    $vacuum2 .= " VACUUM PUMP 2 B ke A";
                } else {
                    $vacuum2 .= " VACUUM PUMP 2 A ke B";
                }
                $jadwalCoUnit2[] = $vacuum2;
            }

            // bfp
            if ($hariIniUnit2["bfp2a"] !== $kemarinUnit2["bfp2a"] || $hariIniUnit2["bfp2b"] !== $kemarinUnit2["bfp2b"] || $hariIniUnit2["bfp2c"] !== $kemarinUnit2["bfp2c"]) {
                $bfp2 = "change over";
                if ($hariIniUnit2["bfp2a"] === $kemarinUnit2["bfp2a"]) {
                    if (!empty($hariIniUnit2["bfp2b"])) {
                        $bfp2 .= " FEED WATER PUMP 2 C ke B";
                    } else {
                        $bfp2 .= " FEED WATER PUMP 2 B ke C";
                    }
                }

                if ($hariIniUnit2["bfp2b"] === $kemarinUnit2["bfp2b"]) {
                    if (!empty($hariIniUnit2["bfp2a"])) {
                        $bfp2 .= " FEED WATER PUMP 2 C ke A";
                    } else {
                        $bfp2 .= " FEED WATER PUMP 2 A ke C";
                    }
                }

                if ($hariIniUnit2["bfp2c"] === $kemarinUnit2["bfp2c"]) {
                    if (!empty($hariIniUnit2["bfp2a"])) {
                        $bfp2 .= " FEED WATER PUMP 2 B ke A";
                    } else {
                        $bfp2 .= " FEED WATER PUMP 2 A ke B";
                    }
                }
                $jadwalCoUnit2[] = $bfp2;
            }

            // eh oil
            if (!empty($hariIniUnit2["ehoilpump2a"]) && !empty($kemarinUnit2["ehoilpump2a"])) {
                if (!empty($hariIniUnit2["ehoilpump2b"])) {
                    $ehoilpump2 = "WARMING UP EH OIL PUMP 2 B";
                    $jadwalCoUnit2[] = $ehoilpump2;
                }
            } elseif (!empty($hariIniUnit2["ehoilpump2b"]) && !empty($kemarinUnit2["ehoilpump2b"])) {
                if (!empty($hariIniUnit2["ehoilpump2a"])) {
                    $ehoilpump2 = "WARMING UP EH OIL PUMP 2 A";
                    $jadwalCoUnit2[] = $ehoilpump2;
                }
            }

            // gland seal fan
            if ($hariIniUnit2["glandsealfan2a"] !== $kemarinUnit2["glandsealfan2a"] || $hariIniUnit2["glandsealfan2b"] !== $kemarinUnit2["glandsealfan2b"]) {
                $glandsealfan2 = "change over";
                if (!empty($hariIniUnit2["glandsealfan2a"])) {
                    $glandsealfan2 .= " GLAND SEAL FAN 2 B ke A";
                } else {
                    $glandsealfan2 .= " GLAND SEAL FAN 2 A ke B";
                }
                $jadwalCoUnit2[] = $glandsealfan2;
            }

            // hpff
            if ($hariIniUnit2["hpff2a"] !== $kemarinUnit2["hpff2a"] || $hariIniUnit2["hpff2b"] !== $kemarinUnit2["hpff2b"] || $hariIniUnit2["hpff2c"] !== $kemarinUnit2["hpff2c"]) {
                $hpff2 = "change over";
                if ($hariIniUnit2["hpff2a"] === $kemarinUnit2["hpff2a"]) {
                    if (!empty($hariIniUnit2["hpff2b"])) {
                        $hpff2 .= " HPFF 2 C ke B";
                    } else {
                        $hpff2 .= " HPFF 2 B ke C";
                    }
                }

                if ($hariIniUnit2["hpff2b"] === $kemarinUnit2["hpff2b"]) {
                    if (!empty($hariIniUnit2["hpff2a"])) {
                        $hpff2 .= " HPFF 2 C ke A";
                    } else {
                        $hpff2 .= " HPFF 2 A ke C";
                    }
                }

                if ($hariIniUnit2["hpff2c"] === $kemarinUnit2["hpff2c"]) {
                    if (!empty($hariIniUnit2["hpff2a"])) {
                        $hpff2 .= " HPFF 2 B ke A";
                    } else {
                        $hpff2 .= " HPFF 2 A ke B";
                    }
                }
                $jadwalCoUnit2[] = $hpff2;
            }

            // oge fan
            if ($hariIniUnit2["ogefan2a"] !== $kemarinUnit2["ogefan2a"] || $hariIniUnit2["ogefan2b"] !== $kemarinUnit2["ogefan2b"]) {
                $ogefan2 = "change over";
                if (!empty($hariIniUnit2["ogefan2a"])) {
                    $ogefan2 .= " OIL GAS EXTRACTOR FAN 2 B ke A";
                } else {
                    $ogefan2 .= " OIL GAS EXTRACTOR FAN 2 A ke B";
                }
                $jadwalCoUnit2[] = $ogefan2;
            }

            // cool fan
            if ($hariIniUnit2["coolingfan2a"] !== $kemarinUnit2["coolingfan2a"] || $hariIniUnit2["coolingfan2b"] !== $kemarinUnit2["coolingfan2b"]) {
                $coolingfan2 = "change over";
                if (!empty($hariIniUnit2["coolingfan2a"])) {
                    $coolingfan2 .= " COOLING FAN 2 B ke A";
                } else {
                    $coolingfan2 .= " COOLING FAN 2 A ke B";
                }
                $jadwalCoUnit2[] = $coolingfan2;
            }
            // ball cleaning

            if (!empty($hariIniUnit2["ballcleaning2"])) {
                $jadwalCoUnit2[] = "PENGOPERASIAN BALL CLEANING #2";
            }
        }
        return $jadwalCoUnit2;
    }
}
