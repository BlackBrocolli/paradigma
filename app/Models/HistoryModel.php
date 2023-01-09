<?php 
namespace App\Models;

use CodeIgniter\Model;

class HistoryModel extends Model
{
    public function getData()
    {
        return $this->db->table('peminjaman')
        ->join('copy_buku','copy_buku.indeks_buku=peminjaman.indeks_buku')
        ->join('buku','buku.id_buku=copy_buku.id_buku')
        ->get()->getResultArray();
    }
}
