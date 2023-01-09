<?= $this->extend('/mahasiswa/templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <div class="row justify-content-md-center">
        <div class="col-lg-12">
            <div class="text-center">
                <form action="<?= base_url(); ?>/home/mhs/reservasi/" method="post">
                    <h2 class="mb-5">Pilih tanggal reservasi</h2>

                    <!-- tampilkan info jika ada -->
                    <div class="d-flex justify-content-center">
                        <div class="mx-auto">
                            <?php if (!empty(session()->getFlashdata('info'))) : ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?php echo session()->getFlashdata('info'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="mx-auto">
                            <div class="mb-3 d-flex flex-row align-items-center">
                                <label for="exampleFormControlInput1" class="form-label mr-2">Tanggal</label>
                                <input class="form-control" type="date" value="" name="tanggal">
                                <input class="form-control" type="hidden" value="<?= $indeks_buku; ?>" name="indeks">
                                <input class="form-control" type="hidden" value="<?= $id_buku; ?>" name="id_buku">
                            </div>
                        </div>
                    </div>

                    <div class="mt-5">

                        <a class="mr-2" href="/home/mhs/detailbuku/<?= $id_buku ?>">Cancel</a>
                        <button class="btn btn-primary">Selesai</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>