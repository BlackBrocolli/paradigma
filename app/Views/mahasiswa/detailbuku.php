<?= $this->extend('/mahasiswa/templates/index'); ?>

<?= $this->section('page-content'); ?>
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

<div class="center">
    <img class="mx-auto d-block" src="/cover/<?= $buku->cover ?>" alt="..." />
</div>
<div class="center">

    <div class="">
        <div class="fs-5 mb-5">
            <figure class="text-center">
                <blockquote class="blockquote">
                    <p>
                    <h1 class="display-5 fw-bolder"> = Informasi Buku = </h1>
                    <span>Judul Buku : <?= $buku->judul; ?></span> <br>
                    <span>Penulis : <?= $buku->penulis; ?></span> <br>
                    <span>Penerbit : <?= $buku->penerbit; ?></span> <br> <br> <br>
                    <span>Sinopsis : </span></p>
                </blockquote>
            </figure>
        </div>
        <figure class="text-center">
            <p class="justify-content-center"><?= $buku->deskripsi ?></p>
        </figure>
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
        </div>
        <div class="fs-5 mb-5">
            <figure class="text-center">
                <blockquote class="blockquote">
                    <h2 class="fw-bolder" style="text-align: center"> = Daftar Copy Buku = </h2><br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Index Buku</th>
                                <th scope="col">Kondisi</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($copyBuku as $dataCopyBuku) : ?>
                                <tr>
                                    <th scope="row"><?= $i ?></th>
                                    <td><?= $dataCopyBuku->indeks_buku ?></td>
                                    <td><?= $dataCopyBuku->kondisi ?></td>
                                    <td><?= $dataCopyBuku->status ?></td>
                                    <td>
                                        <?php if ($dataCopyBuku->status == "tersedia") : ?>
                                            <div class="text-center"><a class="btn btn-outline-dark mt-auto btn-reservasi" href="/home/mhs/tglreservasi/<?= $id_buku ?>/<?= $dataCopyBuku->indeks_buku ?>" id="btn-reservasi">Reservasi</a></div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </blockquote>
            </figure>
        </div>
    </div>
</div>

<!-- Reservasi modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Pilih tanggal reservasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('/home/mhs/reservasi') ?>" method="post">
                <div class="modal-body">
                    <label>Tanggal</label>
                    <input type="text" name="tanggal" id="tanggal" data-provide="datepicker">
                    <input type="hidden" name="indeks_buku" id="indeks_buku" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Menambahkan library jQuery dari CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- kirimkan data $dataCopyBuku->indeks_buku ke dalam input field dengan nama "indeks_buku" pada modal reservasi -->
<script>
    $(document).ready(function() {
        $('#btn-reservasi').on('click', function() {
            $('#indeks_buku').val('<?= $dataCopyBuku->indeks_buku ?>');
        });
    });
</script>

<?= $this->endSection(); ?>