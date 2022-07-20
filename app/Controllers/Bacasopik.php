<?php

namespace App\Controllers;

use App\Models\Data_Nama_Peralatan_Sopik;

class Bacasopik extends BaseController
{

    public function index()
    {
        $peralatan = new Data_Nama_Peralatan_Sopik();
        $data = [
            ['1', $peralatan->allValues(0), 'fa-book', $peralatan->allKeys(0)],
            ['2', $peralatan->allValues(1), 'fa-book', $peralatan->allKeys(1)],
            ['3', $peralatan->allValues(2), 'fa-book', $peralatan->allKeys(2)],
            ['4', $peralatan->allValues(3), 'fa-book', $peralatan->allKeys(3)],
            ['5', $peralatan->allValues(4), 'fa-book', $peralatan->allKeys(4)]
        ];

        $datas = [
            'title' => 'baca sop ik',
            'data' => $data
        ];

        return view('bacasopik/index', $datas);
    }

    public function details($bagian, $namaPeralatan)
    {
        $boiler = 'https://drive.google.com/drive/folders/1Ri6UnOa206v_HF7LhovdIGanya3yzqHj?usp=sharing';
        $turbin = 'https://drive.google.com/drive/folders/1i9XLQx_WecqSBz26Hzx54nb_VqSMzHmq?usp=sharing';
        $alba = 'https://drive.google.com/drive/folders/1P5ZZjGXmFCFO8bmHGAMwHe0xDdfan2FH?usp=sharing';
        $wtp = 'https://drive.google.com/drive/folders/1sKkrZu4jjiIwVa7oluaVYGKN47IgJDIy?usp=sharing';
        $umum = 'https://drive.google.com/drive/folders/18IBMwXVj5vIsY-C38LgdcKJmUsN1xO0s?usp=sharing';

        switch ($bagian) {
            case 'boiler':
                header("Location: $boiler");
                break;
            case 'turbin':
                header("Location: $turbin");
                break;
            case 'alba':
                header("Location: $alba");
                break;
            case 'wtp':
                header("Location: $wtp");
                break;
            default:
                header("Location: $umum");
                break;
        }

        exit;

        // $data = [
        //     'bagian' => $bagian,
        //     'namaPeralatan' => $namaPeralatan
        // ];

        // return view('bacasopik/details', $data);
    }
}
