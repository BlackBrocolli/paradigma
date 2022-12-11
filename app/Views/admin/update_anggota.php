<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update Anggota</h6>
        </div>

        <div class="card-body">

            <?php if (session()->has('errors')) : ?>
                <ul>
                    <?php foreach (session('errors') as $error) : ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?= form_open('/home/updateanggota/' . $edit->nrp) ?>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Kode Anggota</label>
                <input class="form-control" type="text" value="<?= $edit->nrp; ?>" aria-label="readonly input example" readonly>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama Anggota</label>
                <input class="form-control" type="text" value="<?= $edit->nama; ?>" name="nama_anggota">
            </div>

            <button class="btn btn-primary">Save</button>
            <a href="<?= base_url(); ?>/home/anggota">Cancel</a>

            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>