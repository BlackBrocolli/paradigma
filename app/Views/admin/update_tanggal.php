<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update Tanggal Kembali</h6>
        </div>

        <div class="card-body">

            <?php if (session()->has('errors')) : ?>
                <ul>
                    <?php foreach (session('errors') as $error) : ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?= form_open('/home/updatetanggal/' . $edit->id_peminjaman) ?>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tanggal Kembali</label>
                <input class="form-control" type="date" value="<?= $edit->tanggal_kembali; ?>" name="tanggal_kembali">
            </div>


            <button class="btn btn-primary">Save</button>
            <a href="<?= base_url(); ?>/home/peminjaman">Cancel</a>

            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>