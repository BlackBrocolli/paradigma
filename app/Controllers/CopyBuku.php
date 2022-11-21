<?php

namespace App\Controllers;

use App\Models\CopyBukuModel;

class CopyBuku extends BaseController
{
    public function index()
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }
        $data['title'] = 'List Copy Buku';
        $copyBuku = new CopyBukuModel();
        $data['copy'] = $copyBuku->join('buku', 'buku.id_buku = copy_buku.id_buku')->orderBy('indeks_buku', 'asc')->paginate(5);
        $data['pager'] = $copyBuku->pager;
        $data['nomor'] = nomor($this->request->getVar('page'), 5);
        
        return view('admin/list_copy_buku', $data);
    }

    public function delete($indeks){
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }
        $copy = new CopyBukuModel();
        $data['title'] = "Hapus Copy Buku";
        $data['delete'] = $copy->find($indeks);

        if($this->request->getMethod() === 'post'){
            $copy->delete($indeks);
            return redirect()->to('home/copy_buku')->with('info', 'Berhasil menghapus data');
        }

        return view('admin/hapus_copy_buku.php', $data);
    }

    public function editcopybuku($indeks){
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }

        $copy = new CopyBukuModel();
        $data['title'] = "Update Copy Buku";
        $data['edit'] = $copy->join('buku', 'buku.id_buku = copy_buku.id_buku')->find($indeks);

        return view('admin/update_copy_buku', $data);
    }

    public function updatecopybuku($indeks){
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }

        $copy = new CopyBukuModel();

        $result = $copy->save([
            'indeks_buku' => $indeks,
            'kondisi' => $this->request->getPost("kondisi")
        ]);

        if($result == true){
            return redirect()->to('/home/copy_buku')->with('info', 'Berhasil di-update');
        }else{
            return redirect()->to('/home/copy_buku')->with('info', 'Gagal di-update');
        }
    }
}
