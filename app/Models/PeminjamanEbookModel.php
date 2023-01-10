<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanEbookModel extends Model
{
    protected $table      = 'peminjaman_ebook';
    protected $primaryKey = 'id_peminjaman';
    protected $returnType     = 'object';
    protected $allowedFields = ['tanggal_pinjam', 'tanggal_selesai', 'nrp', 'id_ebook'];
    protected $useTimestamps = false;

    protected $validationRules = [
        'tanggal_pinjam' => 'required',
        'tanggal_selesai' => 'required',
        'nrp' => 'required',
        'id_ebook' => 'required'
    ];
}
