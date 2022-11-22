<?php

namespace App\Models;

use CodeIgniter\Model;

class CopyBukuModel extends Model
{
    protected $table      = 'copy_buku';
    protected $primaryKey = 'indeks_buku';
    protected $returnType     = 'object';
    protected $allowedFields = ['indeks_buku', 'kondisi', 'id_buku', 'status'];
    protected $useSoftDeletes = true;
    protected $useTimestamps = false;
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [
        'indeks_buku' => 'required',
        'kondisi' => 'required',
        'id_buku' => 'required',
        'status' => 'required',
    ];
}
