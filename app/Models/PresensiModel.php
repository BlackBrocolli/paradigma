<?php

namespace App\Models;

use CodeIgniter\Model;

class PresensiModel extends Model
{
    protected $table      = 'presensi';
    protected $primaryKey = 'id_presensi';
    protected $returnType     = 'object';
    protected $allowedFields = ['tanggal_datang', 'nrp'];
    protected $useTimestamps = false;

    protected $validationRules = [
        'tanggal_datang' => 'required',
        'nrp' => 'required'
    ];
}
