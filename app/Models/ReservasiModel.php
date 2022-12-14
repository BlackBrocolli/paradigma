<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservasiModel extends Model
{
    protected $table      = 'reservasi';
    protected $primaryKey = 'id_reservasi';
    protected $returnType     = 'object';
    protected $allowedFields = ['nrp', 'indeks_buku', 'tanggal_reservasi', 'status'];
    protected $useTimestamps = false;

    protected $validationRules = [
        'nrp' => 'required',
        'indeks_buku' => 'required',
        'tanggal_reservasi' => 'required',
    ];
}
