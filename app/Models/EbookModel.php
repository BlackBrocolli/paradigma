<?php

namespace App\Models;

use CodeIgniter\Model;

class EbookModel extends Model
{
    protected $table      = 'ebook';
    protected $primaryKey = 'id_ebook';
    protected $returnType     = 'object';
    protected $allowedFields = ['id_ebook', 'judul_ebook', 'path', 'penulis', 'deskripsi', 'halaman', 'cover'];
    protected $useSoftDeletes = true;
    protected $useTimestamps = false;
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [
        'judul_ebook' => 'required',
        'penulis' => 'required',
        'deskripsi' => 'required',
        'halaman' => 'required',
        'sampul' => [
            'rules' => 'uploaded[sampul]|is_image[sampul]|mime_in[sampul,image/jpg,image/png,image/jpeg,]',
            'errors' => [
                'uploaded' => 'Cover hasn\'t been uploaded'
            ]
        ],
        'fileEbook' => [
            'rules' => 'uploaded[fileEbook]|ext_in[fileEbook,pdf]|mime_in[fileEbook,application/pdf]',
            'errors' => [
                'uploaded' => 'File hasn\'t been uploaded'
            ]
        ]
    ];
}
