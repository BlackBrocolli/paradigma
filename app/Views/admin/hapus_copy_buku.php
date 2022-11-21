<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="row justify-content-md-center">
                <div class="col-lg-12">
                    <div class="text-center">

                        <h2>Delete Copy Buku</h2>
                        <p>Are you sure want to delete "<?= $delete->indeks_buku; ?>"</p>

                        <form action="/home/deletecopybuku/<?= $delete->indeks_buku?>" method="post">
                            <button class="btn btn-primary">Yes</button>
                            <a href="<?= site_url('/home/copy_buku') ?>">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>