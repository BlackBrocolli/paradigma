<?php

namespace App\Controllers;

use App\Models\AnggotaModel;
use App\Models\UsersModel;

class Member extends BaseController
{
    public function index()
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }

        $anggota = new AnggotaModel();

        if ($this->request->getGet("cari")) {
            $data['anggota'] = $anggota->like('nrp', $this->request->getGet("cari"), 'both')->orLike('nama', $this->request->getGet("cari"), 'both')->orLike('prodi', $this->request->getGet("cari"), 'both')->orLike('angkatan', $this->request->getGet("cari"), 'both')->orderBy('nrp', 'asc')->paginate(5);
        } else {
            $data['anggota'] = $anggota->orderBy('nrp', 'asc')->paginate(5);
        }

        $data['title'] = 'List Mahasiswa';
        $data['pager'] = $anggota->pager;
        $data['nomor'] = nomor($this->request->getVar('page'), 5);
        return view('admin/list_anggota', $data);
    }

    public function addanggota()
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }
        $data['title'] = 'Tambah Mahasiswa';
        return view('admin/add_anggota', $data);
    }

    public function createanggota()
    {
        $anggota = new AnggotaModel();

        $prodi = $this->request->getPost("select_prodi");
        $angkatan = $this->request->getPost("angkatan");

        // mengatur nrp otomatis sesuai angkatan dan prodi
        $nrp = substr($angkatan, 2);

        if ($prodi == "Teknik Informatika") {
            $nrp = $nrp . "1111";
        } else if ($prodi == "Manajemen Informatika") {
            $nrp = $nrp . "1221";
        } else if ($prodi == "Sistem Informasi") {
            $nrp = $nrp . "1131";
        } else {
            $nrp = $nrp . "2111";
        }

        // random 3 digit
        $digits = 3;
        $nrp = $nrp . str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);

        $result = $anggota->insert([
            'nrp' => $nrp,
            'nama' => $this->request->getPost("nama_mahasiswa"),
            'prodi' => $prodi,
            'angkatan' => $angkatan,
        ]);

        if($result !== false){
            $users = new UsersModel();
            $users->insert([
                'name' => $this->request->getPost("nama_mahasiswa"),
                'email' => $nrp.".mhs.stiki.ac.id",
                'nrp' => $nrp,
                'password' => password_hash($nrp, PASSWORD_BCRYPT)
            ]);
        }

        // cek apakah ada field kosong
        if ($this->request->getPost("nama_mahasiswa") == "" || $this->request->getPost("angkatan") == "") {
            return redirect()->back()
                ->with('errors', $anggota->errors());
        }

        return redirect()->to("/home/anggota")
            ->with('info', 'Berhasil menambahkan data');
    }

    public function deleteanggota($kode_anggota)
    {
        $data['title'] = 'Hapus Anggota';
        $anggota = new AnggotaModel();
        $data['delete'] = $anggota->find($kode_anggota);

        if ($this->request->getMethod() === 'post') {
            $users = new UsersModel();
            $users->where('nrp', $kode_anggota)->delete();
            $anggota->delete($kode_anggota);

            return redirect()->to('/home/anggota')
                ->with('info', 'Berhasil menghapus data');
        }

        return view('admin/hapus_anggota', $data);
    }

    public function editanggota($kode_anggota)
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }
        $data['title'] = 'Update Anggota';
        $anggota = new AnggotaModel();
        $data['edit'] = $anggota->find($kode_anggota);
        return view('admin/update_anggota', $data);
    }

    public function updateanggota($kode_anggota)
    {
        $anggota = new AnggotaModel();

        $result = $anggota->update($kode_anggota, [
            'nama' => $this->request->getPost("nama_anggota")
        ]);

        return redirect()->to('/home/anggota')
            ->with('info', 'Berhasil mengupdate data');
    }
}
