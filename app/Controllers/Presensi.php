<?php

namespace App\Controllers;

use App\Models\PresensiModel;

class Presensi extends BaseController
{
    public function index(){
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }

        $prensensiModel = new PresensiModel();

        $data['title'] = 'Presensi';
        $data['presensi'] = $prensensiModel->join('mahasiswa', 'presensi.nrp = mahasiswa.nrp')->findAll();
        return view('admin/presensi', $data);
    }
}
