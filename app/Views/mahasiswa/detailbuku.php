<?= $this->extend('/mahasiswa/templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="center">
    <img class="mx-auto d-block" src="https://th.bing.com/th/id/R.5933333ffe2cbfbfef0b4d9a8c9873cf?rik=6VNlXFPdGnLRUw&riu=http%3a%2f%2fdimensipers.com%2fwp-content%2fuploads%2f2020%2f04%2fimages-24.jpeg&ehk=AkmKMkfequUKBfhTAqaooVDrLR4VUT4yhhQ9hTAuqCE%3d&risl=&pid=ImgRaw&r=0" alt="..." />
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
    </div>
</div>

<?= $this->endSection(); ?>