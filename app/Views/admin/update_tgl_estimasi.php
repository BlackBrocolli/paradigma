<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="row justify-content-md-center">
                <div class="col-lg-12">
                    <div class="text-center">

                        <h2>Konfirmasi</h2>
                        <p>Tambahkan waktu peminjaman buku "<?= $update->judul; ?>"?</p>

                        <?= form_open("/home/updatetanggal/" . $update->id_peminjaman . "/" . $update->indeks_buku) ?>
                        <button class="btn btn-primary">Yes</button>
                        <a href="<?= site_url('/home/peminjaman') ?>">Cancel</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>