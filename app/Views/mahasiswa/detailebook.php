<?= $this->extend('/mahasiswa/templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="center">
    <img class="mx-auto d-block" src="/cover_ebook/<?= $ebook->cover ?>" alt="..." />
</div>
<div class="center">

    <div class="">
        <div class="fs-5 mb-5">
            <figure class="text-center">
                <blockquote class="blockquote">
                    <p>
                    <h1 class="display-5 fw-bolder"> = Informasi Buku = </h1>
                    <span>Judul Buku : <?= $ebook->judul_ebook; ?></span> <br>
                    <span>Penulis : <?= $ebook->penulis; ?></span> <br>
                    <span>Halaman : <?= $ebook->halaman; ?></span> <br> <br> <br>
                    <span>Sinopsis : </span></p>
                </blockquote>
            </figure>
        </div>
        <figure class="text-center">
            <p class="justify-content-center"><?= $ebook->deskripsi ?></p>
        </figure>
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Pinjam</a></div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>