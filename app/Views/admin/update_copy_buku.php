<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update Copy Buku</h6>
        </div>

        <div class="card-body">

            <?php if (session()->has('errors')) : ?>
                <ul>
                    <?php foreach (session('errors') as $error) : ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form action="/home/updatecopybuku/<?= $edit->indeks_buku; ?>" method="post">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Indeks Buku</label>
                    <input class="form-control" type="text" value="<?= $edit->indeks_buku; ?>" aria-label="readonly input example" readonly>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Judul Buku</label>
                    <input class="form-control" type="text" value="<?= $edit->judul; ?>" aria-label="readonly input example" readonly>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Kondisi</label>
                    <select class="form-select" aria-label="Default select example" name="kondisi">
                        <option value="Baik" <?php if($edit->kondisi == "Baik"){ echo "selected";} ?>>Baik</option>
                        <option value="Rusak" <?php if($edit->kondisi == "Rusak"){ echo "selected";} ?>>Rusak</option>
                    </select>
                </div>

                <button class="btn btn-primary">Save</button>
                <a href="<?= base_url(); ?>/home/copy_buku">Cancel</a>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>