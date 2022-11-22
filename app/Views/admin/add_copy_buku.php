<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Copy Buku</h6>
        </div>

        <div class="card-body">

            <?php if (!empty(session()->getFlashdata('info'))) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?php echo session()->getFlashdata('info'); ?>
                </div>
            <?php endif; ?>

            <?php if (session()->has('errors')) : ?>
                <ul>
                    <?php foreach (session('errors') as $error) : ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form action="/home/createcopybuku" method="post">

                <div class="mb-3">
                    <label for="angkatan" class="form-label">Buku</label>
                    <input id="buku" class="form-control" type="text" value="" name="buku" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jumlah Pertambahan</label>
                    <input class="form-control" type="number" name="tambah">
                </div>
                <button class="btn btn-primary">Save</button>

            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>