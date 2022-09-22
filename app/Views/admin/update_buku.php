<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update Buku</h6>
        </div>

        <div class="card-body">

            <?php if (session()->has('errors')) : ?>
                <ul>
                    <?php foreach (session('errors') as $error) : ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?= form_open('/home/updatebuku/' . $edit->id_buku) ?>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">ID Buku</label>
                <input class="form-control" type="text" value="<?= $edit->id_buku; ?>" aria-label="readonly input example" readonly>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Judul</label>
                <input class="form-control" type="text" value="<?= $edit->judul; ?>" name="judul">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Penulis</label>
                <input class="form-control" type="text" value="<?= $edit->penulis; ?>" name="penulis">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Penerbit</label>
                <input class="form-control" type="text" value="<?= $edit->penerbit; ?>" name="penerbit">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Stok</label>
                <input class="form-control" type="text" value="<?= $edit->stok; ?>" name="stok">
            </div>

            <button class="btn btn-primary">Save</button>
            <a href="<?= base_url(); ?>/home">Cancel</a>

            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>