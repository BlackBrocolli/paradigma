<?php

namespace App\Models;

use CodeIgniter\Model;

class ViewPinjamModel extends Model
{
    protected $table      = 'view_peminjaman';
    protected $primaryKey = 'id_peminjaman';
    protected $returnType     = 'object';
    protected $allowedFields = ['kode_anggota', 'nama_anggota', 'id_buku', 'judul', 'tanggal_pinjam', 'tanggal_kembali', 'status'];
    protected $useTimestamps = true;
}
