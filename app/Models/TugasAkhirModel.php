<?php

namespace App\Models;

use CodeIgniter\Model;

class TugasAkhirModel extends Model
{
    protected $table      = 'ta';
    protected $primaryKey = 'indeks';
    protected $returnType     = 'object';
    protected $allowedFields = ['indeks', 'judul', 'tahun', 'nrp'];
    protected $useTimestamps = false;

    protected $validationRules = [
        'indeks' => [
            'rules' => 'required|is_unique[ta.indeks]',
            'errors' => [
                'is_unique' => 'Indeks TA tidak tersedia'
            ]
        ],
        'judul' => 'required',
        'tahun' => 'required',
        'nrp' => 'required'
    ];
}
