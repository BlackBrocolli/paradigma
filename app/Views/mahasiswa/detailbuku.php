<?= $this->extend('/mahasiswa/templates/index'); ?>

<?= $this->section('page-content'); ?>

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
            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Reservasi</a></div>
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
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach($copyBuku as $dataCopyBuku) : ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $dataCopyBuku->indeks_buku ?></td>
                                <td><?= $dataCopyBuku->kondisi ?></td>
                                <td><?= $dataCopyBuku->status ?></td>
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

<?= $this->endSection(); ?>