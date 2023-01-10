<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="row justify-content-md-center">
                <div class="col-lg-12">
                    <div class="text-center">

                        <h2>Konfirmasi Reservasi</h2>
                        <p>Apakah buku dengan indeks "<?= $indeks_buku; ?>" telah diambil oleh <?= $nrp; ?>?</p>

                        <?= form_open("/home/reservasi/selesai/" . $nrp . "/" . $indeks_buku . "/" . $id_reservasi) ?>
                        <button class="btn btn-primary">Yes</button>
                        <a href="<?= site_url('/home/reservasi') ?>">Cancel</a>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>