<?php

namespace App\Models;

use CodeIgniter\Model;

class PinjamModel extends Model
{
    protected $table      = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';
    protected $returnType     = 'object';
    protected $allowedFields = ['kode_anggota', 'id_buku', 'tanggal_pinjam', 'tanggal_kembali', 'status'];
    protected $useTimestamps = false;

    protected $validationRules = [
        'kode_anggota' => 'required',
        'id_buku' => 'required',
        'tanggal_pinjam' => 'required',
        'tanggal_kembali' => 'required'
    ];
}
