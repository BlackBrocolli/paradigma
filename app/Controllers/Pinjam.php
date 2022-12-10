<?php

namespace App\Controllers;

use App\Models\ViewPinjamModel;
use App\Models\PinjamModel;
use App\Models\BukuModel;
use App\Models\AnggotaModel;
use App\Models\CopyBukuModel;

class Pinjam extends BaseController
{
    // menampilkan halaman peminjaman
    public function index()
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }
        $data['title'] = 'Peminjaman';
        $viewPinjam = new ViewPinjamModel();
        $data['pinjam'] = $viewPinjam->orderBy('id_peminjaman', 'asc')->paginate(10);
        $data['pager'] = $viewPinjam->pager;
        $data['nomor'] = nomor($this->request->getVar('page'), 10);

        // update status peminjaman jika sudah overdue
        $dataPeminjaman = $viewPinjam->orderBy('id_peminjaman', 'asc')->where('status', 'ongoing')->findAll();
        foreach ($dataPeminjaman as $row) {
            // ambil tanggal estimasi kembali dan tanggal sekarang
            $tanggal_estimasi_kembali = $row->tanggal_estimasi_kembali;
            $id_peminjaman = $row->id_peminjaman;

            // cek apakah sudah overdue
            if (strtotime($tanggal_estimasi_kembali) < strtotime('now')) {
                $pinjamModel = new PinjamModel();
                $update = $pinjamModel->update($id_peminjaman, [
                    'status' => 'overdue'
                ]);
            }
        }

        return view('admin/peminjaman', $data);
    }

    // menampilkan view tambah peminjaman
    public function addpeminjaman()
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }
        $data['title'] = 'Tambah Peminjaman';
        // ambil data buku dan anggota untuk dropdown
        $anggota = new AnggotaModel();
        $copybuku = new CopyBukuModel();
        $data['anggota'] = $anggota->orderBy('nrp', 'asc')->findAll();
        $data['copy_buku'] = $copybuku->orderBy('indeks_buku', 'asc')->where('status', 'tersedia')->findAll();
        return view('admin/add_peminjaman', $data);
    }

    // input peminjaman
    public function createpeminjaman()
    {
        // ambil data post yang dikirim
        $datanrp = explode(' - ', $this->request->getPost('nrp'));
        $nrp = $datanrp[0];
        $indeks_buku = $this->request->getPost("indeks_buku");
        $tanggal_pinjam = date("Y-m-d"); // tanggal pinjam sekarang
        // estimasi kembali 7 hari
        $d = strtotime("+7 days");
        $tanggal_estimasi_kembali = date("Y-m-d", $d);

        // jika semua field sudah diisi
        // insert data peminjaman
        $pinjam = new PinjamModel();
        $result = $pinjam->insert([
            'tanggal_pinjam' => $tanggal_pinjam,
            'tanggal_estimasi_kembali' => $tanggal_estimasi_kembali,
            'indeks_buku' => $indeks_buku,
            'nrp' => $nrp
        ]);
        if ($result == true) { // jika berhasil insert peminjaman

            // update status copy buku (tersedia -> dipinjam)
            $copyBuku = new CopyBukuModel();
            $update = $copyBuku->update($indeks_buku, [
                'status' => 'dipinjam'
            ]);

            // ambil id_buku dari tabel copy buku
            $dataCopyBuku = $copyBuku->where('indeks_buku', $indeks_buku)->first();
            $id_buku = $dataCopyBuku->id_buku;

            // ambil stok buku lama
            $bukuModel = new BukuModel();
            $dataBuku = $bukuModel->where('id_buku', $id_buku)->first();
            $stokBukuLama = $dataBuku->stok;

            // update stok buku baru = stok buku lama - 1
            $stokBukuBaru = $stokBukuLama - 1;
            $update = $bukuModel->update($id_buku, [
                'stok' => $stokBukuBaru
            ]);

            // other action

            return redirect()->to("/home/peminjaman")
                ->with('info', 'Berhasil menambahkan data');
        }

        // if ($nrp != "" && $indeks_buku != "") {
        //     // cek stok buku yang ingin dipinjam
        //     $db = \Config\Database::connect();
        //     $query = $db->query('SELECT stok FROM buku WHERE id_buku=' . $id_buku);
        //     $row   = $query->getRow();
        //     $oldstok = $row->stok;
        //     $newstok = $oldstok - 1;

        //     if ($oldstok == 0) {
        //         return redirect()->back()
        //             ->with('info', 'Maaf, stok buku tidak tersedia saat ini');
        //     } else {
        //         $pinjam = new PinjamModel();

        //         $tglPinjam = date('Y-m-d');

        //         // insert data peminjaman
        //         $result = $pinjam->insert([
        //             'tanggal_pinjam' => $tglPinjam,
        //             'tanggal_kembali' => $this->request->getPost("tanggal_kembali"),
        //             'id_buku' => $this->request->getPost("id_buku"),
        //             'nrp' => $this->request->getPost("nrp"),
        //         ]);

        //         // jika berhasil insert data peminjaman
        //         if ($result == true) {
        //             // kurangi stok buku yang dipinjam
        //             $buku = new BukuModel();

        //             $result = $buku->update($id_buku, [
        //                 'stok' => $newstok
        //             ]);

        //             return redirect()->to("/home/peminjaman")
        //                 ->with('info', 'Berhasil menambahkan data');
        //         } else {
        //             return redirect()->back()
        //                 ->with('errors', $pinjam->errors());
        //         }
        //     }
        // }
    }

    public function edittanggal($id_peminjaman)
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }
        $data['title'] = 'Update tanggal';
        $viewPinjam = new ViewPinjamModel();
        $data['edit'] = $viewPinjam->find($id_peminjaman);
        return view('admin/update_tanggal', $data);
    }

    // fitur perpanjang waktu pinjam
    public function updatetanggal($id_peminjaman, $indeks_buku)
    {
        $data['title'] = 'Konfirmasi Tambah Waktu Pinjam';
        $viewPinjam = new ViewPinjamModel();
        $data['update'] = $viewPinjam->find($id_peminjaman);

        if ($this->request->getMethod() === 'post') {
            // ambil tanggal lama
            $pinjamModel = new PinjamModel();
            $dataPinjam = $pinjamModel->where('id_peminjaman', $id_peminjaman)->first();
            $tanggalLama = $dataPinjam->tanggal_estimasi_kembali;

            // atur tanggal baru, +7 hari
            $date = date_create($tanggalLama);
            date_add($date, date_interval_create_from_date_string("7 days"));
            $tanggalBaru = date_format($date, "Y-m-d");

            // update tanggal estimasi kembali
            $result = $pinjamModel->update($id_peminjaman, [
                'tanggal_estimasi_kembali' => $tanggalBaru
            ]);

            return redirect()->to('/home/peminjaman')
                ->with('info', 'Berhasil memperpanjang waktu pinjam');
        }

        return view('admin/update_tgl_estimasi', $data);
    }

    // fitur pengembalian
    // untuk update status peminjaman menjadi selesai
    // lalu mengupdate stok buku pada tabel buku
    public function editstatus($id_peminjaman, $indeks_buku)
    {
        $data['title'] = 'Konfirmasi status';
        $viewPinjam = new ViewPinjamModel();
        $data['update'] = $viewPinjam->find($id_peminjaman);

        if ($this->request->getMethod() === 'post') {

            // update status peminjaman & tanggal kembali
            $pinjam = new PinjamModel();
            $tanggal_kembali = date("Y-m-d"); // tanggal kembali sekarang

            $result = $pinjam->update($id_peminjaman, [
                'status' => 'selesai',
                'tanggal_kembali' => $tanggal_kembali
            ]);

            // update status copy buku (dipinjam -> tersedia)
            $copyBuku = new CopyBukuModel();
            $update = $copyBuku->update($indeks_buku, [
                'status' => 'tersedia'
            ]);

            // stok buku bertambah +1
            // ambil id_buku dari tabel copy buku
            $dataCopyBuku = $copyBuku->where('indeks_buku', $indeks_buku)->first();
            $id_buku = $dataCopyBuku->id_buku;

            // ambil stok buku lama
            $bukuModel = new BukuModel();
            $dataBuku = $bukuModel->where('id_buku', $id_buku)->first();
            $stokBukuLama = $dataBuku->stok;

            // update stok buku baru = stok buku lama - 1
            $stokBukuBaru = $stokBukuLama + 1;
            $update = $bukuModel->update($id_buku, [
                'stok' => $stokBukuBaru
            ]);

            // // update stok buku
            // $db = \Config\Database::connect();
            // $query = $db->query('SELECT stok FROM buku WHERE id_buku=' . $id_buku);
            // $row   = $query->getRow();
            // $oldstok = $row->stok;
            // $newstok = $oldstok + 1;
            // // tambahkan stok buku yang dikembalikan
            // $buku = new BukuModel();

            // $result = $buku->update($id_buku, [
            //     'stok' => $newstok
            // ]);

            return redirect()->to('/home/peminjaman')
                ->with('info', 'Peminjaman selesai');
        }

        return view('admin/update_status', $data);
    }
}
