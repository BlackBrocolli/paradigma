<?= $this->extend('/mahasiswa/templates/index'); ?>

<?= $this->section('page-content'); ?>

<!-- search input -->
<div class="float-right">
    <form class="form-inline" action="/home/mhs" method="get">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search..." name="cari">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>
</div>
<!-- end of search input -->

<br><br><br>

<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
    <?php foreach ($buku as $dataBuku) : ?>
        <div class="col mb-5">
            <div class="card h-100">
                <!-- Product image-->
                <img class="card-img-top" src="/cover/<?= $dataBuku->cover; ?>" alt="..." />
                <!-- Product details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- nama buku-->
                        <h5 class="fw-bolder"><?= $dataBuku->judul ?></h5>
                        <!-- Product price-->
                        karya
                        <br>
                        <h7 class="fw-bolder"><?= $dataBuku->penulis ?></h7>
                    </div>
                </div>
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="/home/mhs/detailbuku/<?= $dataBuku->id_buku ?>">Detail Buku</a></div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection(); ?>