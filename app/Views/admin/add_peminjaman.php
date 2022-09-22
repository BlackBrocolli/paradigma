<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Peminjaman</h6>
        </div>

        <div class="card-body">

            <?php if (session()->has('errors')) : ?>
                <ul>
                    <?php foreach (session('errors') as $error) : ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <!-- tampilkan info jika ada -->
            <?php if (!empty(session()->getFlashdata('info'))) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?php echo session()->getFlashdata('info'); ?>
                </div>
            <?php endif; ?>

            <?= form_open('/home/createpeminjaman') ?>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Kode Anggota</label>
                <select name="kode_anggota" class="form-select">
                    <option value="">Pilih Kode Anggota</option>
                    <?php
                    foreach ($anggota as $row) : ?>
                        <option value="<?= $row->kode_anggota; ?>"><?= $row->kode_anggota; ?> - <?= $row->nama_anggota; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama Buku</label>
                <select name="id_buku" class="form-select">
                    <option value="">Pilih Nama Buku</option>
                    <?php
                    foreach ($buku as $row) : ?>
                        <option value="<?= $row->id_buku; ?>"><?= $row->id_buku; ?> - <?= $row->judul; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tanggal Kembali</label>
                <input class="form-control" type="date" value="" name="tanggal_kembali">
            </div>

            <button class="btn btn-primary">Save</button>
            <a href="<?= base_url("/home/peminjaman") ?>">Cancel</a>

            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>