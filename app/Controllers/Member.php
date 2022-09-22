<?php

namespace App\Controllers;

use App\Models\AnggotaModel;

class Member extends BaseController
{
    public function index()
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }
        $data['title'] = 'List Anggota';
        $anggota = new AnggotaModel();
        $data['anggota'] = $anggota->orderBy('kode_anggota', 'asc')->paginate(5);
        $data['pager'] = $anggota->pager;
        $data['nomor'] = nomor($this->request->getVar('page'), 5);
        return view('admin/list_anggota', $data);
    }

    public function addanggota()
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }
        $data['title'] = 'Tambah Anggota';
        return view('admin/add_anggota', $data);
    }

    public function createanggota()
    {
        $anggota = new AnggotaModel();

        $result = $anggota->insert([
            'nama_anggota' => $this->request->getPost("nama_anggota"),
        ]);

        if ($this->request->getPost("nama_anggota") == "") {
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
            'nama_anggota' => $this->request->getPost("nama_anggota")
        ]);

        return redirect()->to('/home/anggota')
            ->with('info', 'Berhasil mengupdate data');
    }
}
