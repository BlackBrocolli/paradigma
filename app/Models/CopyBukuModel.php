<?php

namespace App\Models;

use CodeIgniter\Model;

class CopyBukuModel extends Model
{
    protected $table      = 'copy_buku';
    protected $primaryKey = 'indeks_buku';
    protected $returnType     = 'object';
    protected $allowedFields = ['indeks_buku', 'kondisi', 'id_buku', 'status'];
    protected $useTimestamps = false;
}