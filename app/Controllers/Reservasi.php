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
}
