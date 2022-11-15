<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Mahasiswa</h6>
        </div>

        <div class="card-body">

            <?php if (session()->has('errors')) : ?>
                <ul>
                    <?php foreach (session('errors') as $error) : ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?= form_open('/home/createanggota') ?>

            <div class="mb-3">
                <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                <input class="form-control" type="text" value="" name="nama_mahasiswa" autocomplete="off">
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="select_prodi">Program Studi</label>
                    <select class="form-control" id="select_prodi" name="select_prodi">
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Manajemen Informatika">Manajemen Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Desain Komunikasi Visual">Desain Komunikasi Visual</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="angkatan" class="form-label">Angkatan</label>
                <input class="form-control" type="text" value="" name="angkatan" autocomplete="off">
            </div>

            <button class="btn btn-primary">Save</button>
            <a href="<?= base_url("/home/anggota") ?>">Cancel</a>

            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>