<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Buku</h6>
        </div>

        <div class="card-body">

            <?php if (session()->has('errors')) : ?>
                <ul>
                    <?php foreach (session('errors') as $error) : ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            
            <form action="/home/createbuku" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Judul</label>
                    <input class="form-control" type="text" value="<?= old('judul'); ?>" name="judul">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Penulis</label>
                    <input class="form-control" type="text" value="<?= old('penulis'); ?>" name="penulis">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Penerbit</label>
                    <input class="form-control" type="text" value="<?= old('penerbit'); ?>" name="penerbit">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Stok</label>
                    <input class="form-control" type="number" value="<?= old('stok'); ?>" name="stok">
                </div>

                <div class="mb-3">
                    <label for="sampul">Cover</label><br>
                    <input type="file" name="sampul" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                </div>

                <button class="btn btn-primary">Save</button>

            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>