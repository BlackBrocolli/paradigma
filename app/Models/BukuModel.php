<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table      = 'buku';
    protected $primaryKey = 'id_buku';
    protected $returnType     = 'object';
    protected $allowedFields = ['judul', 'penulis', 'penerbit', 'stok'];
    protected $useTimestamps = false;

    protected $validationRules = [
        'judul' => 'required',
        'penulis' => 'required',
        'penerbit' => 'required',
        'stok' => 'required'
    ];
}
