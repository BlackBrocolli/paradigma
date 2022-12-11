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
    protected $useSoftDeletes = true;
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'nama' => 'required',
        'angkatan' => 'required',
    ];
}
