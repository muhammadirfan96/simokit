<?php

namespace App\Models;

use CodeIgniter\Model;

class LimasAlbaKeduaModel extends Model
{
    protected $table      = 'limasalbakedua';
    protected $allowedFields = [];

    protected $peralatanAlbaKedua = [
        "compressor generator",
        "EDG",
        "panel EDG",
        "EDG & battery room pltg Alsthom",
        "panel pltg (elcon)",
        "mesin Alsthom (turbin & generator)",
        "switch gear room 400 v #1",
        "switch gear room 400 v #2"
    ];

    public function limasAlbaKeduaFix()
    {
        $limasAlbaKedua = $this->orderBy('id', 'desc')->findAll(31, 0);
        $limasAlbaKeduaID = [];
        foreach ($limasAlbaKedua as $row) {
            $limasAlbaKeduaID[] = $row['id'];
        }
        asort($limasAlbaKeduaID);
        $limasAlbaKeduaFix = [];
        foreach ($limasAlbaKeduaID as $fix) {
            $limasAlbaKeduaFix[] = $this->find($fix);
        }
        return $limasAlbaKeduaFix;
    }

    public function limasAlbaKedua()
    {
        $limasAlbaKedua = [];
        if ($this->where(['tanggal' => date('Y-m-d')])->orderBy('id', 'desc')->first() == null) {
            $limasAlbaKedua[] = 'data belum diinput';
        } else {
            $rowLimasAlbaKedua = array_values($this->where(['tanggal' => date('Y-m-d')])->first());

            for ($i = 0; $i < count($rowLimasAlbaKedua); $i++) {
                if (!empty($rowLimasAlbaKedua[$i + 2])) {
                    $limasAlbaKedua[] = $this->peralatanAlbaKedua[$i];
                }
            }
        }
        return $limasAlbaKedua;
    }
}
