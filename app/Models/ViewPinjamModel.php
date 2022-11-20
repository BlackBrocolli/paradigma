<?php

namespace App\Models;

use CodeIgniter\Model;

class ViewPinjamModel extends Model
{
    protected $table      = 'view_peminjaman';
    protected $primaryKey = 'id_peminjaman';
    protected $returnType     = 'object';
    protected $allowedFields = ['nrp', 'nama', 'indeks_buku', 'judul', 'tanggal_pinjam', 'tanggal_kembali', 'status', 'tanggal_estimasi_kembali'];
    protected $useTimestamps = true;
}
