<?php

namespace App\Controllers;

use App\Models\EbookModel;
use App\Models\PeminjamanEbookModel;

class Ebook extends BaseController
{
    public function index()
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }

        $ebookModel = new EbookModel();

        if ($this->request->getGet("cari")) {
            $data['ebook'] = $ebookModel->like('judul_ebook', $this->request->getGet("cari"), 'both')->orLike('penulis', $this->request->getGet("cari"), 'both')->orderBy('judul_ebook', 'asc')->paginate(5);
        } else {
            $data['ebook'] = $ebookModel->orderBy('judul_ebook', 'asc')->paginate(5);
        }

        $data['title'] = "Ebook";

        $data['pager'] = $ebookModel->pager;
        $data['nomor'] = nomor($this->request->getVar('page'), 5);

        return view('admin/list_ebook', $data);
    }

    public function addebook()
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }

        $data['title'] = "Add Ebook";

        return view('admin/add_ebook', $data);
    }

    public function createebook()
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }

        $ebookModel = new EbookModel();

        $cover = $this->request->getFile('sampul');
        $coverName = $cover->getRandomName();

        $fileEbook = $this->request->getFile('fileEbook');
        $fileName = $fileEbook->getRandomName();

        $result = $ebookModel->insert([
            'judul_ebook' => $this->request->getPost('judul_ebook'),
            'path' => $fileName,
            'penulis' => $this->request->getPost('penulis'),
            'halaman' => $this->request->getPost('halaman'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'cover' => $coverName
        ]);

        if ($result !== false) {
            $cover->move('cover_ebook', $coverName);
            $fileEbook->move('file_ebook', $fileName);
            return redirect()->to('home/ebook')->with('info', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->withInput()->with('errors', $ebookModel->errors());
        }
    }

    public function deleteebook($id)
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }

        $data['title'] = 'Hapus buku';
        $ebookModel = new EbookModel();
        $data['delete'] = $ebookModel->find($id);

        if ($this->request->getMethod() === 'post') {

            $ebookModel->delete($id);
            return redirect()->to('/home/ebook')->with('info', 'Berhasil menghapus data');
        }

        return view('admin/hapus_ebook', $data);
    }

    public function editebook($id)
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }

        $data['title'] = 'Update Ebook';
        $ebookModel = new EbookModel();
        $data['ebook'] = $ebookModel->find($id);

        return view('admin/update_ebook', $data);
    }

    public function updateebook($id)
    {
        $ebookModel = new EbookModel();

        $cover = $this->request->getFile('sampul');

        $fileEbook = $this->request->getFile('fileEbook');

        if ($fileEbook->getError() == 4) {
            $fileName = $this->request->getPost("fileLama");
        } else {
            $fileName = $fileEbook->getRandomName();
            unlink('file_ebook/' . $this->request->getPost("fileLama"));
            $fileEbook->move('file_ebook', $fileName);
        }

        if ($cover->getError() == 4) {
            $coverName = $this->request->getPost("coverLama");
        } else {
            $coverName = $cover->getRandomName();
            unlink('cover_ebook/' . $this->request->getPost("coverLama"));
            $cover->move('cover_ebook', $coverName);
        }

        
        $result = $ebookModel->update($id, [
            'judul_ebook' => $this->request->getPost('judul_ebook'),
            'path' => $fileName,
            'penulis' => $this->request->getPost('penulis'),
            'halaman' => $this->request->getPost('halaman'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'cover' => $coverName            
        ]);

        if($result !== false){
            return redirect()->to('/home/ebook')->with('info', 'Berhasil mengupdate data');
        }else{
            return redirect()->back()->with('errors', $ebookModel->errors());
        }
    }

    public function bacaebook($idPeminjaman)
    {
        if (session()->get('level') !== 'anggota') { // jika bukan admin
            return redirect()->to(base_url('login'));
        }

        $peminjamanEbookModel = new PeminjamanEbookModel();
        $dataPeminjaman = $peminjamanEbookModel->join('ebook', 'peminjaman_ebook.id_ebook = ebook.id_ebook')->find($idPeminjaman);

        if($dataPeminjaman){
            if($dataPeminjaman->tanggal_selesai > date('Y-m-d')){

                $data['title'] = "Baca ebook";
                $data['judulEbook'] = $dataPeminjaman->judul_ebook;
                $data['ebook'] = $dataPeminjaman->path;
                return view('mahasiswa/bacaebook', $data);
            }else{
                session()->setFlashdata('info', 'Anda tidak meminjam ebook');
                return redirect()->to(base_url('home/mhs/history'));
            }
        }else{
            session()->setFlashdata('info', 'Anda tidak meminjam ebook');
            return redirect()->to(base_url('home/mhs/history'));
        }
    }

    public function pinjamebook($idEbook){
        if (session()->get('level') !== 'anggota') { // jika bukan admin
            return redirect()->to(base_url('login'));
        }

        $peminjamanEbookModel = new PeminjamanEbookModel();
        
        $result = $peminjamanEbookModel->insert([
            'tanggal_pinjam' => date('Y-m-d'),
            'tanggal_selesai' => date('Y-m-d', strtotime("+7 days")),
            'nrp' => session()->get('nrp'),
            'id_ebook' => $idEbook
        ]);

        if($result !== false){
            return redirect()->back()->with('info', 'Berhasil dipinjam');
        }else{
            return redirect()->back()->with('info', 'Gagal dipinjam');
        }
    }
}
