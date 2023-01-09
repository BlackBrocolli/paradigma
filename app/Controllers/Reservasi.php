<?php

namespace App\Controllers;

use App\Models\PinjamModel;
use App\Models\ReservasiModel;

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
            return redirect()->back()
                ->with('info', 'Tanggal tidak boleh kosong!');
        } else if (strtotime($tanggal) < strtotime('now')) { // tidak boleh reservasi di masa lalu
            return redirect()->back()
                ->with('info', 'Maaf, reservasi maksimal 1 hari sebelumnya.');
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
}
