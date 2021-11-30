<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceRequestModel extends Model
{
    protected $table      = 'srcm';
    protected $primaryKey = 'id';
    protected $allowedFields = [];
}
