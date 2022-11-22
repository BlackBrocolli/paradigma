<?php

namespace App\Models;

use CodeIgniter\Model;

class PinjamModel extends Model
{
    protected $table      = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';
    protected $returnType     = 'object';
    protected $allowedFields = ['nrp', 'indeks_buku', 'tanggal_pinjam', 'tanggal_kembali', 'tanggal_estimasi_kembali', 'status'];
    protected $useTimestamps = false;

    protected $validationRules = [
        'nrp' => 'required',
        'indeks_buku' => 'required',
        'tanggal_pinjam' => 'required',
        'tanggal_estimasi_kembali' => 'required'
    ];
}
