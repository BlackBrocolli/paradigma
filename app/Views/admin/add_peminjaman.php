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
                <label for="exampleFormControlInput1" class="form-label">NRP</label>
                <input id="nrp" class="form-control" type="text" value="" name="nrp" autocomplete="off">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Indeks Buku</label>
                <input id="indeks_buku" class="form-control" type="text" value="" name="indeks_buku" autocomplete="off">
            </div>

            <button class="btn btn-primary">Save</button>
            <a href="<?= base_url("/home/peminjaman") ?>">Cancel</a>

            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>