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
        $data = [
            'title' => 'sop ' . $namaPeralatan,
            'bagian' => $bagian,
            'namaPeralatan' => $namaPeralatan
        ];

        // $this->response->setContentType('application/pdf');

        return view('bacasopik/details', $data);
    }
}
