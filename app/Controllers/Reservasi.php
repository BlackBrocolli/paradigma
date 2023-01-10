<?php

namespace App\Controllers;

use App\Models\PinjamModel;
use App\Models\ReservasiModel;
use App\Models\CopyBukuModel;
use App\Models\BukuModel;

class Reservasi extends BaseController
{
    // menampilkan halaman reservasi
    public function index()
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }

        $reservasiModel = new ReservasiModel();

        if ($this->request->getGet("cari")) {
            $data['reservasi'] = $reservasiModel->join('mahasiswa', 'mahasiswa.nrp = reservasi.nrp')->join('copy_buku', 'copy_buku.indeks_buku = reservasi.indeks_buku')->like('tanggal_reservasi', $this->request->getGet("cari"), 'both')->orLike('reservasi.nrp', $this->request->getGet("cari"), 'both')->orLike('reservasi.indeks_buku', $this->request->getGet("cari"), 'both')->orLike('reservasi.status', $this->request->getGet("cari"), 'both')->orderBy('tanggal_reservasi', 'desc')->paginate(5);
        } else {
            $data['reservasi'] = $reservasiModel->orderBy('tanggal_reservasi', 'desc')->paginate(10);
        }

        $data['title'] = 'Reservasi';
        $data['pager'] = $reservasiModel->pager;
        $data['nomor'] = nomor($this->request->getVar('page'), 10);

        // update status reservasi -> batal jika sudah lewat batas pengambilan
        // $dataPeminjaman = $viewPinjam->orderBy('id_peminjaman', 'asc')->where('status', 'ongoing')->findAll();
        // foreach ($dataPeminjaman as $row) {
        //     // ambil tanggal estimasi kembali dan tanggal sekarang
        //     $tanggal_estimasi_kembali = $row->tanggal_estimasi_kembali;
        //     $id_peminjaman = $row->id_peminjaman;

        //     // cek apakah sudah overdue
        //     if (strtotime($tanggal_estimasi_kembali) < strtotime('now')) {
        //         $pinjamModel = new PinjamModel();
        //         $update = $pinjamModel->update($id_peminjaman, [
        //             'status' => 'overdue'
        //         ]);
        //     }
        // }

        return view('admin/reservasi', $data);
    }

    public function process()
    {
        // tangkap data POST tanggal
        $tanggal = $_POST['tanggal'];
        // tanggal tidak boleh kosong

        // tangkap nrp dari session
        $nrp = session()->get('nrp');
        // tangkap juga indeks buku dari input field hidden
        // $indeks_buku = $indeks;
        $indeks_buku = $_POST['indeks'];
        $id_buku = $_POST['id_buku'];

        // cek tanggal
        // tanggal tidak boleh kosong
        if ($tanggal == '') {
            return redirect()->to('/home/mhs/tglreservasi/' . $id_buku . '/' . $indeks_buku)
                ->with('infotgl', 'Tanggal tidak boleh kosong!');
        } else if (strtotime($tanggal) < strtotime('now')) { // tidak boleh reservasi di masa lalu
            return redirect()->to('/home/mhs/tglreservasi/' . $id_buku . '/' . $indeks_buku)
                ->with('infotgl', 'Maaf, reservasi maksimal 1 hari sebelumnya.');
        }

        // proses reservasi
        $reservasi = new ReservasiModel();
        $result = $reservasi->insert([
            'nrp' => $nrp,
            'tanggal_reservasi' => $tanggal,
            'indeks_buku' => $indeks_buku,
        ]);

        return redirect()->to('/home/mhs/detailbuku/' . $id_buku)
            ->with('info', 'Berhasil reservasi buku!');
    }

    public function tglreservasi($id_buku, $indeks_buku)
    {

        $data['indeks_buku'] = $indeks_buku;
        $data['id_buku'] = $id_buku;
        $data['title'] = 'Reservasi';
        return view('mahasiswa/reservasi', $data);
    }

    public function confirmselesai($nrp, $indeks_buku, $id_reservasi)
    {

        $data['indeks_buku'] = $indeks_buku;
        $data['nrp'] = $nrp;
        $data['id_reservasi'] = $id_reservasi;
        $data['title'] = 'Konfirmasi Reservasi';

        if ($this->request->getMethod() === 'post') {
            // // ambil tanggal lama
            // $pinjamModel = new PinjamModel();
            // $dataPinjam = $pinjamModel->where('id_peminjaman', $id_peminjaman)->first();
            // $tanggalLama = $dataPinjam->tanggal_estimasi_kembali;

            // // atur tanggal baru, +7 hari
            // $date = date_create($tanggalLama);
            // date_add($date, date_interval_create_from_date_string("7 days"));
            // $tanggalBaru = date_format($date, "Y-m-d");

            // // update tanggal estimasi kembali
            // $result = $pinjamModel->update($id_peminjaman, [
            //     'tanggal_estimasi_kembali' => $tanggalBaru
            // ]);

            // RESERVASI SELESAI, ISI TABEL PEMINJAMAN
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

                // update status reservasi = selesai
                $reservasiModel = new ReservasiModel();
                $result = $reservasiModel->update($id_reservasi, [
                    'status' => 'selesai'
                ]);


                return redirect()->to('/home/reservasi')
                    ->with('info', 'Reservasi selesai');
            }
        }

        return view('admin/confirmreservasi', $data);
    }
}
