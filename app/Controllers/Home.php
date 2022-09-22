<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Home extends BaseController
{

    public function index()
    {
        $data['title'] = 'Home';
        $buku = new BukuModel();
        $data['buku'] = $buku->orderBy('judul', 'asc')->paginate(5);
        $data['pager'] = $buku->pager;
        $data['nomor'] = nomor($this->request->getVar('page'), 5);
        return view('user/index', $data);
    }

    public function addbuku()
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }
        $data['title'] = 'Tambah Buku';
        return view('admin/add_buku', $data);
    }

    public function createbuku()
    {
        $buku = new BukuModel();

        $result = $buku->insert([
            'judul' => $this->request->getPost("judul"),
            'penulis' => $this->request->getPost("penulis"),
            'penerbit' => $this->request->getPost("penerbit"),
            'stok' => $this->request->getPost("stok"),
        ]);

        if ($result == true) {
            return redirect()->to("/home")
                ->with('info', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()
                ->with('errors', $buku->errors());
        }
    }

    public function deletebuku($id_buku)
    {
        $data['title'] = 'Hapus buku';
        $buku = new BukuModel();
        $data['delete'] = $buku->find($id_buku);

        if ($this->request->getMethod() === 'post') {
            $buku->delete($id_buku);

            return redirect()->to('/home')
                ->with('info', 'Berhasil menghapus data');
        }

        return view('admin/hapus_buku', $data);
    }

    public function editbuku($id_buku)
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }
        $data['title'] = 'Update buku';
        $buku = new BukuModel();
        $data['edit'] = $buku->find($id_buku);
        return view('admin/update_buku', $data);
    }

    public function updatebuku($id_buku)
    {
        $buku = new BukuModel();

        $result = $buku->update($id_buku, [
            'judul' => $this->request->getPost("judul"),
            'penulis' => $this->request->getPost("penulis"),
            'penerbit' => $this->request->getPost("penerbit"),
            'stok' => $this->request->getPost("stok")
        ]);

        return redirect()->to('/home')
            ->with('info', 'Berhasil mengupdate data');
    }

    public function myprofile()
    {
        $data['title'] = 'Update buku';
        return view('user/myprofile', $data);
    }
}
