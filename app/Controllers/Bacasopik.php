<?php

namespace App\Controllers;

use App\Models\Array_daftarSopIk;

class Bacasopik extends BaseController
{
    public function index()
    {
        $peralatan = new Array_daftarSopIk();

        $data = [
            'title' => 'baca sop ik',
            'peralatan' => $peralatan->semuaPeralatan()
        ];

        return view('bacasopik/index', $data);
    }
}
