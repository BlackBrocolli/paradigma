<?php

namespace App\Controllers;

use App\Models\AnggotaModel;
use App\Models\PresensiModel;
use CodeIgniter\I18n\Time;

class Absensi extends BaseController
{
    public function index(){
        $anggotaModel = new AnggotaModel();

        $data['title'] = 'Absensi';
        $data['mahasiswa'] = $anggotaModel->findAll();
        return view('mahasiswa/absensi', $data);
    }

    public function input(){
        
        if($this->request->getPost('dataMahasiswa') != 0){
            $presensiModel = new PresensiModel();
            $time = Time::parse(Time::now('Asia/Jakarta', 'en_US'));
            $cek = $presensiModel->where(['tanggal_datang' => $time->toLocalizedString("yyyy-MM-dd"), 'nrp' => $this->request->getPost('dataMahasiswa')])->findAll();

            if($cek){
                session()->setFlashdata('error', 'Sudah melakukkan presensi!');
                return redirect()->back();
            }
            
            $result = $presensiModel->insert([
                'tanggal_datang' => $time->toLocalizedString("yyyy-MM-dd"),
                'nrp' => $this->request->getPost('dataMahasiswa')
            ]);

            if($result !== false){
                session()->setFlashdata('error', 'Presensi berhasil dicatat!');
                return redirect()->back();
            }else{
                session()->setFlashdata('error', 'Input gagal mohon coba lagi');
                return redirect()->back();    
            }
        }else{            
            session()->setFlashdata('error', 'Mohon pilih data mahasiswa');
            return redirect()->back();
        }
    }
}
