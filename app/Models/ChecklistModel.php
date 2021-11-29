<?php

namespace App\Models;

use CodeIgniter\Model;

class ChecklistModel extends Model
{
    protected $table      = 'checklist';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tanggal', 'diinput_oleh', 'namaPeralatan', 'catatan'];
}
