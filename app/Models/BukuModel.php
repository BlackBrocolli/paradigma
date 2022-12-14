<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table      = 'buku';
    protected $primaryKey = 'id_buku';
    protected $returnType     = 'object';
    protected $allowedFields = ['judul', 'penulis', 'penerbit', 'stok', 'deskripsi', 'cover'];
    protected $useSoftDeletes = true;
    protected $useTimestamps = false;
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [
        'judul' => 'required',
        'penulis' => 'required',
        'penerbit' => 'required',
        'stok' => 'required|greater_than[0]',
        'deskripsi' => 'required',
        'sampul' => [
            'rules' => 'uploaded[sampul]|is_image[sampul]|mime_in[sampul,image/jpg,image/png,image/jpeg,]',
            'errors' => [
                'uploaded' => 'Cover hasn\'t been uploaded'
            ]
        ]
    ];
}
