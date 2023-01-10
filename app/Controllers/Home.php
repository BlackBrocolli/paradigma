<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\CopyBukuModel;
use App\Models\EbookModel;
use App\Models\PinjamModel;
use App\Models\PeminjamanEbookModel;
use App\Models\UsersModel;

class Home extends BaseController
{

    public function index()
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->back();
        }

        $data['title'] = 'Dashboard';
        return view('admin/dashboard', $data);
    }

    public function index_mhs()
    {
        $buku = new BukuModel();

        if ($this->request->getGet("cari")) {
            $data['buku'] = $buku->like('judul', $this->request->getGet("cari"), 'both')->orLike('penulis', $this->request->getGet("cari"), 'both')->orLike('penerbit', $this->request->getGet("cari"), 'both')->orderBy('judul', 'asc')->findAll();
        } else {
            $data['buku'] = $buku->orderBy('judul', 'asc')->findAll();
        }

        $data['title'] = 'Dashboard';
        return view('mahasiswa/index', $data);
    }

    public function mhs_detailbuku($id)
    {
        $bukuModel = new BukuModel();
        $copyBukuModel = new CopyBukuModel();

        $data['buku'] = $bukuModel->find($id);
        $data['copyBuku'] = $copyBukuModel->where('id_buku', $id)->findAll();
        $data['id_buku'] = $id;
        $data['title'] = 'Detail buku';
        return view('mahasiswa/detailbuku', $data);
    }

    public function mhs_ebook()
    {
        $ebook = new EbookModel();

        if ($this->request->getGet("cari")) {
            $data['ebook'] = $ebook->like('judul_ebook', $this->request->getGet("cari"), 'both')->orLike('penulis', $this->request->getGet("cari"), 'both')->orderBy('judul_ebook', 'asc')->findAll();
        } else {
            $data['ebook'] = $ebook->orderBy('judul_ebook', 'asc')->findAll();
        }

        $data['title'] = 'Ebook';
        return view('mahasiswa/ebook', $data);
    }

    public function mhs_detail_ebook($id)
    {
        $ebook = new EbookModel();
        $peminjamanEbookModel = new PeminjamanEbookModel();

        $data['ebook'] = $ebook->find($id);
        $data['title'] = 'Detail Ebook';
        $data['isBorrowed'] = $peminjamanEbookModel->where(['id_ebook' => $id, 'nrp' => session()->get('nrp'), 'tanggal_selesai >' => date('Y-m-d')])->findAll();

        return view('mahasiswa/detailebook', $data);
    }

    public function mhs_history()
    {
        if (session()->get('level') !== 'anggota') { // jika bukan admin
            return redirect()->to(base_url('login'));
        }

        $modelPeminjaman = new PinjamModel();
        $peminjamanEbookModel = new PeminjamanEbookModel();

        $data['title'] = 'Riwayat Peminjaman';
        $data['peminjaman'] = $modelPeminjaman->select('peminjaman.*, buku.judul')->join('copy_buku', 'peminjaman.indeks_buku = copy_buku.indeks_buku')->join('buku', 'copy_buku.id_buku = buku.id_buku')->where('nrp', session()->get('nrp'))->findAll();
        $data['pinjam_ebook'] = $peminjamanEbookModel->join('ebook', 'peminjaman_ebook.id_ebook = ebook.id_ebook')->where('nrp', session()->get('nrp'))->findAll();

        return view('mahasiswa/history', $data);
    }

    public function readbuku()
    {
        $data['title'] = 'Buku';
        $buku = new BukuModel();

        if ($this->request->getGet("cari")) {
            $data['buku'] = $buku->like('judul', $this->request->getGet("cari"), 'both')->orLike('penulis', $this->request->getGet("cari"), 'both')->orLike('penerbit', $this->request->getGet("cari"), 'both')->orderBy('judul', 'asc')->paginate(5);
        } else {
            $data['buku'] = $buku->orderBy('judul', 'asc')->paginate(5);
        }

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
            'deskripsi' => $this->request->getPost("deskripsi"),
            'cover' => $newCoverName
        ]);

        if ($result !== false) {
            $cover->move('cover', $newCoverName);
            $this->createCopyBuku($this->request->getPost("judul"), $this->request->getPost("penulis"), $this->request->getPost("stok"), $buku->insertID());
            return redirect()->to("/home/buku")
                ->with('info', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()
                ->withInput()->with('errors', $buku->errors());
        }
    }

    public function createCopyBuku($judul, $penulis, $stok, $id)
    {
        $copy = new CopyBukuModel();

        $indeksJudul = "";

        $judulArray = explode(' ', $judul);

        if (count($judulArray) > 1) {
            for ($i = 0; $i < 3; $i++) {
                if ($i < count($judulArray)) {
                    $judulArray[$i] = strtoupper(substr($judulArray[$i], 0, 1));
                    $indeksJudul .= $judulArray[$i];
                }
            }
        } else {
            $indeksJudul = strtoupper(substr($judul, 0, 1));
        }

        $random = mt_rand(100, 999);

        for ($i = 0; $i < $stok; $i++) {

            $copy->insert([
                'indeks_buku' => $random . "-" . $indeksJudul . "-" . substr(strtolower($penulis), 0, 3) . "-" . ($i + 1),
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
            $coverModel = new CopyBukuModel();
            $copyBuku = $coverModel->where('id_buku', $id_buku)->findAll();

            foreach ($copyBuku as $row) {
                $coverModel->delete($row->indeks_buku);
            }

            $buku->delete($id_buku);
            return redirect()->to('/home/buku')
                ->with('info', 'Berhasil menghapus data');
        }

        return view('admin/hapus_buku', $data);
    }

    public function editbuku($id_buku)
    {
        if (session()->get('level') !== 'admin') { // jika bukan admin
            return redirect()->to(base_url('login'));
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

        if ($cover->getError() == 4) {
            $namaSampul = $this->request->getPost("sampulLama");
        } else {
            $namaSampul = $cover->getRandomName();
            unlink('cover/' . $this->request->getPost("sampulLama"));
            $cover->move('cover', $namaSampul);
        }

        $result = $buku->update($id_buku, [
            'judul' => $this->request->getPost("judul"),
            'penulis' => $this->request->getPost("penulis"),
            'penerbit' => $this->request->getPost("penerbit"),
            'stok' => $this->request->getPost("stok"),
            'deskripsi' => $this->request->getPost("deskripsi"),
            'cover' => $namaSampul
        ]);

        return redirect()->to('/home/buku')
            ->with('info', 'Berhasil mengupdate data');
    }

    public function debugging()
    {
        $data['title'] = 'Debugging';
        return view('index.php', $data);
    }

    public function mhs_profil(){
        if (session()->get('level') !== 'anggota') { // jika bukan admin
            return redirect()->to(base_url('login'));
        }

        $data['title'] = "Profil";

        return view('mahasiswa/profil', $data);
    }

    public function mhs_ganti_password(){
        if (session()->get('level') !== 'anggota') { // jika bukan admin
            return redirect()->to(base_url('login'));
        }

        $usersModel = new UsersModel();

        if (!$this->validate([
            'passwordLama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password lama harus diisi',
                ]
            ],

            'passwordBaru' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password baru harus diisi'
                ]
            ],
            'repasswordBaru' => [
                'rules' => 'required|matches[passwordBaru]',
                'errors' => [
                    'required' => 'Input password ulang harus diisi',
                    'matches' => 'Konfirmasi Password tidak sesuai dengan password',
                ]
            ],
        ])) {
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->back()->withInput()->with('errors', $usersModel->errors());
        }

        $dataUser = $usersModel->where('email', session()->get('email'))->first();

        if($dataUser){
            $password = $this->request->getPost('passwordLama');
            if(password_verify($password, $dataUser->password)){
                $result = $usersModel->where('nrp', session()->get('nrp'))->set(['password' => password_hash($this->request->getPost('passwordBaru'), PASSWORD_BCRYPT),])->update();

                if($result !== false){
                    return redirect()->back()->with('info', 'Berhasil mengupdate password');
                }else{
                    return redirect()->back()->with('info', 'Gagal mengupdate password');
                }
            }else{
                session()->setFlashdata('info', 'Password yang Anda masukkan salah');
                return redirect()->to(base_url('home/mhs/profil'));
            }
        }
    }
}
