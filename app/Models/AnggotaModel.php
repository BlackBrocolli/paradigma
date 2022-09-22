<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table      = 'anggota';
    protected $primaryKey = 'kode_anggota';
    protected $returnType     = 'object';
    protected $allowedFields = ['nama_anggota'];
    protected $useTimestamps = false;

    protected $validationRules = [
        'nama_anggota' => 'required',
    ];
}
