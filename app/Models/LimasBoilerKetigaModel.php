<?php

namespace App\Models;

use CodeIgniter\Model;

class LimasBoilerKetigaModel extends Model
{
    protected $table      = 'limasboilerketiga';
    protected $primaryKey = 'id';
    protected $allowedFields = [];

    protected $peralatanBoilerKetiga = [
        "hpff 1a",
        "hpff 2a",
        "hpff 1b",
        "hpff 2b",
        "hpff 1c",
        "hpff 2c",
        "motor bottom ash cooler 1a",
        "motor bottom ash cooler 2a",
        "motor bottom ash cooler 1b",
        "motor bottom ash cooler 2b",
        "MOV to slagcooler #1",
        "MOV to slagcooler #2",
        "lower burner 1a",
        "lower burner 2a",
        "lower burner 1b",
        "lower burner 2b",
        "lower burner 1c",
        "lower burner 2c",
        "lower burner 1d",
        "lower burner 2d"
    ];

    public function limasBoilerKetigaFix()
    {
        $limasBoilerKetiga = $this->orderBy('id', 'desc')->findAll(31, 0);
        $limasBoilerKetigaID = [];
        foreach ($limasBoilerKetiga as $row) {
            $limasBoilerKetigaID[] = $row['id'];
        }
        asort($limasBoilerKetigaID);
        $limasBoilerKetigaFix = [];
        foreach ($limasBoilerKetigaID as $fix) {
            $limasBoilerKetigaFix[] = $this->find($fix);
        }
        return $limasBoilerKetigaFix;
    }

    public function limasBoilerKetiga()
    {
        $limasBoilerKetiga = [];
        if ($this->where(['tanggal' => date('Y-m-d')])->orderBy('id', 'desc')->first() == null) {
            $limasBoilerKetiga[] = 'data belum diinput';
        } else {
            $rowLimasBoilerKetiga = array_values($this->where(['tanggal' => date('Y-m-d')])->first());

            for ($i = 0; $i < count($rowLimasBoilerKetiga); $i++) {
                if (!empty($rowLimasBoilerKetiga[$i + 2])) {
                    $limasBoilerKetiga[] = $this->peralatanBoilerKetiga[$i];
                }
            }
        }

        return $limasBoilerKetiga;
    }
}
