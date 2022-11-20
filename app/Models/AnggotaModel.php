<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table      = 'mahasiswa';
    protected $primaryKey = 'nrp';
    protected $returnType     = 'object';
    protected $allowedFields = ['nama', 'prodi', 'angkatan', 'nrp'];
    protected $useTimestamps = false;

    protected $validationRules = [
        'nama' => 'required',
        'angkatan' => 'required',
    ];
}
