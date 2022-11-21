<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\CopyBukuModel;

class Home extends BaseController
{

    public function index()
    {
        $data['title'] = 'Dashboard';
        return view('admin/dashboard', $data);
    }

    public function readbuku()
    {
        $data['title'] = 'Buku';
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

        $cover = $this->request->getFile("sampul");
        $newCoverName = $cover->getRandomName(); 

        $result = $buku->insert([
            'judul' => $this->request->getPost("judul"),
            'penulis' => $this->request->getPost("penulis"),
            'penerbit' => $this->request->getPost("penerbit"),
            'stok' => $this->request->getPost("stok"),
            'cover' => $newCoverName
        ]);

        if ($result == true) {
            $cover->move('cover', $newCoverName);
            $this->createCopyBuku($this->request->getPost("judul"), $this->request->getPost("penulis"), $this->request->getPost("stok"),$buku->insertID());
            return redirect()->to("/home")
                ->with('info', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()
                ->withInput()->with('errors', $buku->errors());
        }
    }

    public function createCopyBuku($judul, $penulis, $stok, $id){
        $copy = new CopyBukuModel();
        
        $indeksJudul ="";

        $judulArray = explode(' ', $judul);

        if(count($judulArray) > 1){
            for($i =0; $i < 3; $i++){
                if($i < count($judulArray)){
                    $judulArray[$i] = strtoupper(substr($judulArray[$i], 0, 1));
                    $indeksJudul .= $judulArray[$i];
                }
            }
        }else{
            $indeksJudul = strtoupper(substr($judul, 0, 1));
        }

        $random = mt_rand(100, 999);

        for($i = 0; $i < $stok; $i++){
            
            $copy->insert([
                'indeks_buku' => $random."-". $indeksJudul."-".substr(strtolower($penulis), 0, 3)."-".$i+1,
                'kondisi' => 'Baik',
                'id_buku' => $id,
                'status' => 'tersedia'
            ]);
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

        $cover = $this->request->getFile("sampul");

        if($cover->getError() == 4){
            $namaSampul = $this->request->getPost("sampulLama");
        }else{
            $namaSampul = $cover->getRandomName();
            unlink('cover/'.$this->request->getPost("sampulLama"));
            $cover->move('cover', $namaSampul);
        }

        $result = $buku->update($id_buku, [
            'judul' => $this->request->getPost("judul"),
            'penulis' => $this->request->getPost("penulis"),
            'penerbit' => $this->request->getPost("penerbit"),
            'stok' => $this->request->getPost("stok"),
            'cover' => $namaSampul
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
