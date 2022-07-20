<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KwhSeeder extends Seeder
{
    public function run()
    {
        //
        $data = [
            [
                'diinput' => '7 | ' . date('Y-m-d H:i:s'),
                'waktu' => date('Y-m-01 10:00:00'),
                'kit1' => 12287.97,
                'kit2' => 11811.70,
                'ps1' => 7472.54,
                'ps2' => 7090.05,
                'et1' => 1746.40,
                'et2' => 1704.72,
            ],
            [
                'diinput' => '7 | ' . date('Y-m-d H:i:s'),
                'waktu' => date('Y-m-02 10:00:00'),
                'kit1' => 12290.97,
                'kit2' => 11813.92,
                'ps1' => 7474.14,
                'ps2' => 7097.57,
                'et1' => 1746.78,
                'et2' => 1705.01,
            ],
            [
                'diinput' => '7 | ' . date('Y-m-d H:i:s'),
                'waktu' => date('Y-m-03 10:00:00'),
                'kit1' => 12292.25,
                'kit2' => 11814.89,
                'ps1' => 7474.82,
                'ps2' => 7098.22,
                'et1' => 1746.95,
                'et2' => 1705.14,
            ],
            [
                'diinput' => '7 | ' . date('Y-m-d H:i:s'),
                'waktu' => date('Y-m-04 10:00:00'),
                'kit1' => 12294.61,
                'kit2' => 11816.19,
                'ps1' => 7475.76,
                'ps2' => 7099.73,
                'et1' => 1747.19,
                'et2' => 1705.39,
            ],
            [
                'diinput' => '7 | ' . date('Y-m-d H:i:s'),
                'waktu' => date('Y-m-05 10:00:00'),
                'kit1' => 12296.99,
                'kit2' => 11818.70,
                'ps1' => 7477.35,
                'ps2' => 7100.74,
                'et1' => 1747.60,
                'et2' => 1705.69
            ]
        ];

        $this->db->table('kwh')->insertBatch($data);
    }
}

// $ php spark db:seed ListOfKpiSeeder
