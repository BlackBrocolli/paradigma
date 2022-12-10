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
        $data['title'] = 'Reservasi';
        $reservasiModel = new ReservasiModel();
        $data['reservasi'] = $reservasiModel->orderBy('tanggal_reservasi', 'desc')->paginate(10);
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
