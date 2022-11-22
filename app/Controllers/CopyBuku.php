<?php

namespace App\Controllers;

use App\Models\CopyBukuModel;
use App\Models\BukuModel;

class CopyBuku extends BaseController
{
    public function index()
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }
        $data['title'] = 'List Copy Buku';
        $copyBuku = new CopyBukuModel();

        if ($this->request->getGet("cari")) {
            $data['copy'] = $copyBuku->join('buku', 'buku.id_buku = copy_buku.id_buku')->like('indeks_buku', $this->request->getGet("cari"), 'both')->orLike('judul', $this->request->getGet("cari"), 'both')->orderBy('indeks_buku', 'asc')->paginate(5);
        } else {
            $data['copy'] = $copyBuku->join('buku', 'buku.id_buku = copy_buku.id_buku')->orderBy('indeks_buku', 'asc')->paginate(5);
        }

        $data['pager'] = $copyBuku->pager;
        $data['nomor'] = nomor($this->request->getVar('page'), 5);

        return view('admin/list_copy_buku', $data);
    }

    public function delete($indeks)
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }

        $copy = new CopyBukuModel();

        $data['title'] = "Hapus Copy Buku";
        $data['delete'] = $copy->find($indeks);

        if ($this->request->getMethod() === 'post') {
            $bukuModel = new BukuModel();

            $copyBuku = $copy->find($indeks);
            $copy->delete($indeks);
            $buku = $bukuModel->find($copyBuku->id_buku);

            $bukuModel->save([
                'id_buku' => $copyBuku->id_buku,
                'stok' => $buku->stok - 1
            ]);
            return redirect()->to('home/copy_buku')->with('info', 'Berhasil menghapus data');
        }

        return view('admin/hapus_copy_buku.php', $data);
    }

    public function editcopybuku($indeks)
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }

        $copy = new CopyBukuModel();
        $data['title'] = "Update Copy Buku";
        $data['edit'] = $copy->join('buku', 'buku.id_buku = copy_buku.id_buku')->find($indeks);

        return view('admin/update_copy_buku', $data);
    }

    public function updatecopybuku($indeks)
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }

        $copy = new CopyBukuModel();

        $result = $copy->save([
            'indeks_buku' => $indeks,
            'kondisi' => $this->request->getPost("kondisi")
        ]);

        if ($result == true) {
            return redirect()->to('/home/copy_buku')->with('info', 'Berhasil di-update');
        } else {
            return redirect()->to('/home/copy_buku')->with('info', 'Gagal di-update');
        }
    }

    public function addcopybuku()
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }

        $bukuModel = new BukuModel();

        $data['buku'] = $bukuModel->find();
        $data['title'] = "Tambah Copy Buku";

        return view('admin/add_copy_buku', $data);
    }

    public function createcopybuku()
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }

        $bukuModel = new BukuModel();
        $dataBuku = explode(' - ', $this->request->getPost('buku'));

        if (count($dataBuku) == 2) {
            if (!empty($this->request->getPost('tambah')) || $this->request->getPost('tambah') < 0) {
                if ($bukuModel->where('id_buku', $dataBuku[1])->countAllResults() > 0) {
                    $copyModel = new CopyBukuModel();

                    $copyBuku = $copyModel->where('id_buku', $dataBuku[1])->withDeleted()->findAll();

                    if ($copyModel->where('id_buku', $dataBuku[1])->withDeleted()->countAllResults() > 0) {
                        $nomorCopy = [];

                        $terbesar = 0;
                        for ($i = 0; $i < count($copyBuku); $i++) {
                            if ($i == 0) {
                                $terbesar = (int) explode('-', $copyBuku[$i]->indeks_buku)[3];
                            } else {
                                if ($terbesar < (int) explode('-', $copyBuku[$i]->indeks_buku)[3]) {
                                    $terbesar = (int) explode('-', $copyBuku[$i]->indeks_buku)[3];
                                }
                            }
                        }

                        $indeksCopy = $terbesar + 1;

                        $indeksRandom = explode('-', $copyModel->where('id_buku', $dataBuku[1])->withDeleted()->first()->indeks_buku)[0];
                        $indeksJudul = explode('-', $copyModel->where('id_buku', $dataBuku[1])->withDeleted()->first()->indeks_buku)[1];
                        $indeksPenulis = explode('-', $copyModel->where('id_buku', $dataBuku[1])->withDeleted()->first()->indeks_buku)[2];

                        for ($i = 0; $i < $this->request->getPost('tambah'); $i++) {
                            $result = $copyModel->insert([
                                'indeks_buku' => $indeksRandom . '-' . $indeksJudul . '-' . $indeksPenulis . '-' . ($indeksCopy + $i),
                                'kondisi' => 'Baik',
                                'id_buku' => $dataBuku[1],
                                'status' => 'tersedia'
                            ]);
                        }
                    } else {
                        $copy = new CopyBukuModel();
                        $bukuModel = new BukuModel();

                        $penulis = $bukuModel->find($dataBuku[1])->penulis;

                        $indeksJudul = "";

                        $judulArray = explode(' ', $dataBuku[0]);

                        if (count($judulArray) > 1) {
                            for ($i = 0; $i < 3; $i++) {
                                if ($i < count($judulArray)) {
                                    $judulArray[$i] = strtoupper(substr($judulArray[$i], 0, 1));
                                    $indeksJudul .= $judulArray[$i];
                                }
                            }
                        } else {
                            $indeksJudul = strtoupper(substr($dataBuku[0], 0, 1));
                        }

                        $random = mt_rand(100, 999);

                        for ($i = 0; $i < $this->request->getPost('tambah'); $i++) {

                            $copy->insert([
                                'indeks_buku' => $random . "-" . $indeksJudul . "-" . substr(strtolower($penulis), 0, 3) . "-" . ($i + 1),
                                'kondisi' => 'Baik',
                                'id_buku' => $dataBuku[1],
                                'status' => 'tersedia'
                            ]);
                        }
                    }

                    $bukuModel->save([
                        'id_buku' => $dataBuku[1],
                        'stok' => $bukuModel->find($dataBuku[1])->stok + $this->request->getPost('tambah')
                    ]);

                    return redirect()->to('/home/copy_buku')->with('info', 'Berhasil ditambahkan');
                } else {
                    return redirect()->to('/home/addcopybuku')->with('info', 'Buku Tidak ada!');
                }
            } else {
                return redirect()->to('/home/addcopybuku')->with('info', 'Input pertambahan tidak valid!');
            }
        } else {
            return redirect()->to('/home/addcopybuku')->with('info', 'Input tidak valid!');
        }
    }
}
