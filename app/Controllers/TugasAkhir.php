<?php

namespace App\Controllers;

use App\Models\TugasAkhirModel;
use App\Models\AnggotaModel;

class TugasAkhir extends BaseController
{
    public function index()
    {  
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }

        $tugasAkhirModel = new TugasAkhirModel();

        if ($this->request->getGet("cari")) {
            $data['tugasakhir'] = $tugasAkhirModel->join('mahasiswa', 'mahasiswa.nrp = ta.nrp')->like('judul', $this->request->getGet("cari"), 'both')->orLike('nama', $this->request->getGet("cari"), 'both')->orLike('prodi', $this->request->getGet("cari"), 'both')->orLike('ta.nrp', $this->request->getGet("cari"), 'both')->orLike('indeks', $this->request->getGet("cari"), 'after')->paginate(5);
        } else {
            $data['tugasakhir'] = $tugasAkhirModel->join('mahasiswa', 'mahasiswa.nrp = ta.nrp')->orderBy('indeks', 'asc')->paginate(5);
        }


        $data['title'] = "Tugas Akhir";

        $data['pager'] = $tugasAkhirModel->pager;
        $data['nomor'] = nomor($this->request->getVar('page'), 5);

        return view('admin/list_tugas_akhir', $data);
    }

    public function addtugasakhir(){
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }

        $mahasiswaModel = new AnggotaModel();

        $data['title'] = "Add Tugas Akhir";
        $data['mahasiswa'] = $mahasiswaModel->findAll();

        return view('admin/add_tugas_akhir', $data);
    }

    public function createtugasakhir(){
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }

        $errors = [];
        
        if(empty($this->request->getPost('indeks'))){
            $errors[] = "Nomor TA tidak boleh kosong";
        }

        if(count(explode(' - ', $this->request->getPost('penulis'))) != 2){
            $errors[] = "Input penulis kosong/tidak valid";
        }

        if(empty($this->request->getPost('judul'))){
            $errors[] = "Judul tidak boleh kosong";
        }

        if(empty($this->request->getPost('tahun'))){
            $errors[] = "Tahun tidak boleh kosong";
        }else if($this->request->getPost('tahun') < 1985){
            $errors[] = "Input tahun tidak valid";
        }

        if(count($errors) == 0){
            $tugasAkhirModel = new TugasAkhirModel();
            $mahasiswaModel = new AnggotaModel();

            $nrp = explode(' - ', $this->request->getPost('penulis'))[0];
            $dataProdi = $mahasiswaModel->find($nrp);

            if($dataProdi->prodi == "Teknik Informatika"){
                $indeksTa = "01-".$this->request->getPost('indeks');
            }else if($dataProdi->prodi == "Manajemen Informatika"){
                $indeksTa = "02-".$this->request->getPost('indeks');
            }else if($dataProdi->prodi == "Sistem Informasi"){
                $indeksTa = "05-".$this->request->getPost('indeks');
            }else if($dataProdi->prodi == "Desain Komunikasi Visual"){
                $indeksTa = "03-".$this->request->getPost('indeks');
            }

            $tugasAkhirModel->insert([
                'indeks' => $indeksTa,
                'judul' => $this->request->getPost('judul'),
                'tahun' => $this->request->getPost('tahun'),
                'nrp' => $nrp
            ]);

            if(isset($tugasAkhirModel->errors()['indeks'])){
                $errors[] = $tugasAkhirModel->errors()['indeks'];
                return redirect()->to('/home/addtugasakhir')->withInput()->with('errors', $errors);    
            }else{
                return redirect()->to("/home/tugasakhir")->with('info', 'Berhasil menambahkan data');
            }
        }else{
            return redirect()->to('/home/addtugasakhir')->withInput()->with('errors', $errors);
        }
    }

    public function edittugasakhir($id){
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }

        $data['title'] = 'Update Tugas Akhir';
        $tugasAkhirModel = new TugasAkhirModel();
        $data['tugasakhir'] = $tugasAkhirModel->join('mahasiswa', 'mahasiswa.nrp = ta.nrp')->find($id);

        return view('admin/update_tugas_akhir', $data);
    }

    public function updatetugasakhir($id){
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }

        $errors = [];
        
        if(empty($this->request->getPost('indeks'))){
            $errors[] = "Nomor TA tidak boleh kosong";
        }

        if(count(explode(' - ', $this->request->getPost('penulis'))) != 2){
            $errors[] = "Input penulis kosong/tidak valid";
        }

        if(empty($this->request->getPost('judul'))){
            $errors[] = "Judul tidak boleh kosong";
        }

        if(empty($this->request->getPost('tahun'))){
            $errors[] = "Tahun tidak boleh kosong";
        }else if($this->request->getPost('tahun') < 1985){
            $errors[] = "Input tahun tidak valid";
        }

        if(count($errors) == 0){
            $tugasAkhirModel = new TugasAkhirModel();
            $mahasiswaModel = new AnggotaModel();

            $nrp = explode(' - ', $this->request->getPost('penulis'))[0];
            $dataProdi = $mahasiswaModel->find($nrp);

            if($dataProdi->prodi == "Teknik Informatika"){
                $indeksTa = "01-".$this->request->getPost('indeks');
            }else if($dataProdi->prodi == "Manajemen Informatika"){
                $indeksTa = "02-".$this->request->getPost('indeks');
            }else if($dataProdi->prodi == "Sistem Informasi"){
                $indeksTa = "05-".$this->request->getPost('indeks');
            }else if($dataProdi->prodi == "Desain Komunikasi Visual"){
                $indeksTa = "03-".$this->request->getPost('indeks');
            }

            if($this->request->getPost('indeks') == explode('-', $id)[1]){
                $dataUpdate = [
                    'judul' => $this->request->getPost('judul'),
                    'tahun' => $this->request->getPost('tahun'),
                    'nrp' => $nrp
                ];
            }else{
                $dataUpdate = [
                    'indeks' => $indeksTa,
                    'judul' => $this->request->getPost('judul'),
                    'tahun' => $this->request->getPost('tahun'),
                    'nrp' => $nrp
                ];
            }

            $tugasAkhirModel->update($id, $dataUpdate);

            if(isset($tugasAkhirModel->errors()['indeks'])){
                $errors[] = $tugasAkhirModel->errors()['indeks'];
                return redirect()->to('/home/edittugasakhir/'.$id)->withInput()->with('errors', $errors);    
            }else{
                return redirect()->to("/home/tugasakhir")->with('info', 'Berhasil menambahkan data');
            }
        }else{
            return redirect()->to('/home/edittugasakhir/'.$id)->withInput()->with('errors', $errors);
        }
    }

    public function deletetugasakhir($id){
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }

        $data['title'] = 'Hapus tugas akhir';
        $tugasAkhirModel = new TugasAkhirModel();
        $data['delete'] = $tugasAkhirModel->find($id);

        if ($this->request->getMethod() === 'post') {

            $tugasAkhirModel->delete($id);
            return redirect()->to('/home/tugasakhir')->with('info', 'Berhasil menghapus data');
        }

        return view('admin/hapus_tugas_akhir', $data);
    }
}
