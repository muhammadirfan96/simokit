<?php

namespace App\Models;

use CodeIgniter\Model;

class ScheduleCommonModel extends Model
{
    protected $table      = 'schedulecommon';
    protected $primaryKey = 'id';
    protected $allowedFields = [];
    protected $tools = [
        "air compressor instrument & service a",
        "air compressor instrument & service b",
        "air compressor instrument & service c",
        "air compressor conveying a",
        "air compressor conveying b",
        "air compressor conveying c",
        "AC central equipment 1 a",
        "AC central equipment 1 b",
        "AC central equipment 2 a",
        "AC central equipment 2 b",
        "AC central ccr a",
        "AC central ccr b",
        "warming up edg",
        "warming up auxilliary boiler"
    ];

    public function scheduleCommon()
    {
        $jadwalCoCommon = [];
        if ($this->where(['tanggal' => date('Y-m-d')])->orderBy('id', 'desc')->first() == null) {
            $jadwalCoCommon[] = "data belum diinput";
        } else {
            $hariIniCommon = $this->where(['tanggal' => date('Y-m-d')])->orderBy('id', 'desc')->first();
            $kemarinCommon = $this->where(['tanggal' => date('Y-m-d', strtotime("-1 day", strtotime(date('Y-m-d'))))])->orderBy('id', 'desc')->first();

            // compressor instrument service 
            if ($hariIniCommon["compressorinstrumentservicea"] !== $kemarinCommon["compressorinstrumentservicea"] || $hariIniCommon["compressorinstrumentserviceb"] !== $kemarinCommon["compressorinstrumentserviceb"] || $hariIniCommon["compressorinstrumentservicec"] !== $kemarinCommon["compressorinstrumentservicec"]) {
                $compressorinstrumentservice = "change over";
                if ($hariIniCommon["compressorinstrumentservicea"] === $kemarinCommon["compressorinstrumentservicea"]) {
                    if (!empty($hariIniCommon["compressorinstrumentserviceb"])) {
                        $compressorinstrumentservice .= " COMPRESSOR INSTRUMENT & SERVICE C ke B";
                    } else {
                        $compressorinstrumentservice .= " COMPRESSOR INSTRUMENT & SERVICE B ke C";
                    }
                }

                if ($hariIniCommon["compressorinstrumentserviceb"] === $kemarinCommon["compressorinstrumentserviceb"]) {
                    if (!empty($hariIniCommon["compressorinstrumentservicea"])) {
                        $compressorinstrumentservice .= " COMPRESSOR INSTRUMENT & SERVICE C ke A";
                    } else {
                        $compressorinstrumentservice .= " COMPRESSOR INSTRUMENT & SERVICE A ke C";
                    }
                }

                if ($hariIniCommon["compressorinstrumentservicec"] === $kemarinCommon["compressorinstrumentservicec"]) {
                    if (!empty($hariIniCommon["compressorinstrumentservicea"])) {
                        $compressorinstrumentservice .= " COMPRESSOR INSTRUMENT & SERVICE B ke A";
                    } else {
                        $compressorinstrumentservice .= " COMPRESSOR INSTRUMENT & SERVICE A ke B";
                    }
                }
                $jadwalCoCommon[] = $compressorinstrumentservice;
            }

            // compressor conveying 
            if ($hariIniCommon["compressorconveyinga"] !== $kemarinCommon["compressorconveyinga"] || $hariIniCommon["compressorconveyingb"] !== $kemarinCommon["compressorconveyingb"] || $hariIniCommon["compressorconveyingc"] !== $kemarinCommon["compressorconveyingc"]) {
                $compressorconveying = "change over";
                if ($hariIniCommon["compressorconveyinga"] === $kemarinCommon["compressorconveyinga"]) {
                    if (!empty($hariIniCommon["compressorconveyingb"])) {
                        $compressorconveying .= " COMPRESSOR CONVEYING C ke B";
                    } else {
                        $compressorconveying .= " COMPRESSOR CONVEYING B ke C";
                    }
                }

                if ($hariIniCommon["compressorconveyingb"] === $kemarinCommon["compressorconveyingb"]) {
                    if (!empty($hariIniCommon["compressorconveyinga"])) {
                        $compressorconveying .= " COMPRESSOR CONVEYING C ke A";
                    } else {
                        $compressorconveying .= " COMPRESSOR CONVEYING A ke C";
                    }
                }

                if ($hariIniCommon["compressorconveyingc"] === $kemarinCommon["compressorconveyingc"]) {
                    if (!empty($hariIniCommon["compressorconveyinga"])) {
                        $compressorconveying .= " COMPRESSOR CONVEYING B ke A";
                    } else {
                        $compressorconveying .= " COMPRESSOR CONVEYING A ke B";
                    }
                }
                $jadwalCoCommon[] = $compressorconveying;
            }

            // AC central equipment1
            if ($hariIniCommon["ACcentralequipment1a"] !== $kemarinCommon["ACcentralequipment1a"] || $hariIniCommon["ACcentralequipment1b"] !== $kemarinCommon["ACcentralequipment1b"]) {
                $ACcentralequipment1 = "change over";
                if (!empty($hariIniCommon["ACcentralequipment1a"])) {
                    $ACcentralequipment1 .= " AC CENTRAL EQUPMENT 1 B ke A";
                } else {
                    $ACcentralequipment1 .= " AC CENTRAL EQUPMENT 1 A ke B";
                }
                $jadwalCoCommon[] = $ACcentralequipment1;
            }

            // AC central equipment2
            if ($hariIniCommon["ACcentralequipment2a"] !== $kemarinCommon["ACcentralequipment2a"] || $hariIniCommon["ACcentralequipment2b"] !== $kemarinCommon["ACcentralequipment2b"]) {
                $ACcentralequipment2 = "change over";
                if (!empty($hariIniCommon["ACcentralequipment2a"])) {
                    $ACcentralequipment2 .= " AC CENTRAL EQUPMENT 2 B ke A";
                } else {
                    $ACcentralequipment2 .= " AC CENTRAL EQUPMENT 2 A ke B";
                }
                $jadwalCoCommon[] = $ACcentralequipment2;
            }

            // AC central ccr
            if ($hariIniCommon["ACcentralccra"] !== $kemarinCommon["ACcentralccra"] || $hariIniCommon["ACcentralccrb"] !== $kemarinCommon["ACcentralccrb"]) {
                $ACcentralccr = "change over";
                if (!empty($hariIniCommon["ACcentralccra"])) {
                    $ACcentralccr .= " AC CENTRAL CCR B ke A";
                } else {
                    $ACcentralccr .= " AC CENTRAL CCR A ke B";
                }
                $jadwalCoCommon[] = $ACcentralccr;
            }
            // warming up edg
            if (!empty($hariIniCommon["warmingupedg"])) {
                $jadwalCoCommon[] = "WARMING UP EDG";
            }

            // warming up aux boiler
            if (!empty($hariIniCommon["warmingupauxboiler"])) {
                $jadwalCoCommon[] = "WARMING UP AUX BOILER";
            }
        }
        return $jadwalCoCommon;
    }
}
