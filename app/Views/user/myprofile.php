<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">My Profile</h1>

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0" style="margin: 8px;">
                    <div class="col-md-4">
                        <img src="<?= base_url(); ?>/img/undraw_profile.svg"" class=" img-fluid rounded-start" alt="<?= session()->get('name'); ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <h4><?= session()->get('name'); ?></h4>
                                </li>

                                <li class="list-group-item">
                                    <?= session()->get('email'); ?>
                                </li>

                                <li class="list-group-item">
                                    <span class="badge badge-<?= (session()->get('level') == 'admin') ? 'success' : 'warning'; ?>">
                                        <span><?= session()->get('level'); ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>