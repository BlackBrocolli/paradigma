<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Ebook</h6>
        </div>

        <div class="card-body">

            <?php if (session()->has('errors')) : ?>
                <ul>
                    <?php foreach (session('errors') as $error) : ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form action="/home/updateebook/<?= $ebook->id_ebook?>" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?= $ebook->path; ?>" name="fileLama">
                <input type="hidden" value="<?= $ebook->cover; ?>" name="coverLama">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Judul</label>
                    <input class="form-control" type="text" value="<?= $ebook->judul_ebook; ?>" name="judul_ebook">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Penulis</label>
                    <input class="form-control" type="text" value="<?= $ebook->penulis; ?>" name="penulis">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Halaman</label>
                    <input class="form-control" type="number" value="<?= $ebook->halaman; ?>" name="halaman">
                </div>
                <div class="mb-3">
                    <label for="sampul">Cover</label><br>
                    <input type="file" name="sampul" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                </div>
                <div class="mb-3">
                    <label for="sampul">File Ebook</label><br>
                    <input type="file" name="fileEbook" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                </div>
                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>