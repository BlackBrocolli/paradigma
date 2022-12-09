<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update Tugas Akhir</h6>
        </div>

        <div class="card-body">

            <?php if (!empty(session()->getFlashdata('errors'))) : ?>
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form action="/home/updatetugasakhir/<?= $tugasakhir->indeks; ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nomor TA</label>
                    <input id="indeks" class="form-control" type="number" value="<?= explode('-', $tugasakhir->indeks)[1]; ?>" name="indeks" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Penulis</label>
                    <input id="penulis" class="form-control" type="text" value="<?= $tugasakhir->nrp." - ".$tugasakhir->nama; ?>" name="penulis" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Judul</label>
                    <input id="judul" class="form-control" type="text" value="<?= $tugasakhir->judul; ?>" name="judul" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tahun Tugas Akhir</label>
                    <input class="form-control" type="number" value="<?= $tugasakhir->tahun; ?>" name="tahun">
                </div>
                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>