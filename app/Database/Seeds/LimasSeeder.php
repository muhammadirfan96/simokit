<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LimasSeeder extends Seeder
{
    public function run()
    {
        //
        $data = [
            [
                'diinput_oleh' => '9617075fby',
                'tanggal' => date('Y-m-06 10:00:00'),
                'namaPeralatan' => 'ce2f',
                'area' => 'boiler #1',
                'saran' => 'hanya saran',
                'fotoSebelum' => 'ada',
                'fotoSetelah' => 'ada',
                'approved' => 'n',
            ],
            [
                'diinput_oleh' => '9617075fby',
                'tanggal' => date('Y-m-09 10:00:00'),
                'namaPeralatan' => 'ce2f',
                'area' => 'boiler #1',
                'saran' => 'hanya saran',
                'fotoSebelum' => 'ada',
                'fotoSetelah' => 'ada',
                'approved' => 'n',
            ],
            [
                'diinput_oleh' => '9617075fby',
                'tanggal' => date('Y-m-11 10:00:00'),
                'namaPeralatan' => 'ce2f',
                'area' => 'boiler #1',
                'saran' => 'hanya saran',
                'fotoSebelum' => 'ada',
                'fotoSetelah' => 'ada',
                'approved' => 'n',
            ],
            [
                'diinput_oleh' => '9617075fby',
                'tanggal' => date('Y-m-12 10:00:00'),
                'namaPeralatan' => 'ce2f',
                'area' => 'boiler #1',
                'saran' => 'hanya saran',
                'fotoSebelum' => 'ada',
                'fotoSetelah' => 'ada',
                'approved' => 'n',
            ],
            [
                'diinput_oleh' => '9617075fby',
                'tanggal' => date('Y-m-12 10:00:00'),
                'namaPeralatan' => 'ce2f',
                'area' => 'boiler #1',
                'saran' => 'hanya saran',
                'fotoSebelum' => 'ada',
                'fotoSetelah' => 'ada',
                'approved' => 'n',
            ],
            [
                'diinput_oleh' => '9617075fby',
                'tanggal' => date('Y-m-12 10:00:00'),
                'namaPeralatan' => 'ce2f',
                'area' => 'boiler #1',
                'saran' => 'hanya saran',
                'fotoSebelum' => 'ada',
                'fotoSetelah' => 'ada',
                'approved' => 'n',
            ],
            [
                'diinput_oleh' => '9617075fby',
                'tanggal' => date('Y-m-13 10:00:00'),
                'namaPeralatan' => 'ce2f',
                'area' => 'boiler #1',
                'saran' => 'hanya saran',
                'fotoSebelum' => 'ada',
                'fotoSetelah' => 'ada',
                'approved' => 'n',
            ],
            [
                'diinput_oleh' => '9617075fby',
                'tanggal' => date('Y-m-14 10:00:00'),
                'namaPeralatan' => 'ce2f',
                'area' => 'boiler #1',
                'saran' => 'hanya saran',
                'fotoSebelum' => 'ada',
                'fotoSetelah' => 'ada',
                'approved' => 'n',
            ],
            [
                'diinput_oleh' => '9617075fby',
                'tanggal' => date('Y-m-15 10:00:00'),
                'namaPeralatan' => 'ce2f',
                'area' => 'boiler #1',
                'saran' => 'hanya saran',
                'fotoSebelum' => 'ada',
                'fotoSetelah' => 'ada',
                'approved' => 'n',
            ],
            [
                'diinput_oleh' => '9617075fby',
                'tanggal' => date('Y-m-16 10:00:00'),
                'namaPeralatan' => 'ce2f',
                'area' => 'boiler #1',
                'saran' => 'hanya saran',
                'fotoSebelum' => 'ada',
                'fotoSetelah' => 'ada',
                'approved' => 'n',
            ],
            [
                'diinput_oleh' => '9617075fby',
                'tanggal' => date('Y-m-16 10:00:00'),
                'namaPeralatan' => 'ce2f',
                'area' => 'boiler #1',
                'saran' => 'hanya saran',
                'fotoSebelum' => 'ada',
                'fotoSetelah' => 'ada',
                'approved' => 'n',
            ],
        ];

        $this->db->table('limas')->insertBatch($data);
    }
}

// $ php spark db:seed ListOfKpiSeeder
