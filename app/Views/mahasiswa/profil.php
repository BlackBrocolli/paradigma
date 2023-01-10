<?= $this->extend('/mahasiswa/templates/index'); ?>

<?= $this->section('page-content'); ?>

<!-- history buku -->
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-center">
            <h2>Profil Pengguna</h2>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <td scope="col">Nama</td>
                    <td scope="col"><?= session()->get('name') ?></td>
                </tr>
                <tr>
                    <td scope="col">NRP</td>
                    <td scope="col"><?= session()->get('nrp') ?></td>
                </tr>
                <tr>
                    <td scope="col">Email</td>
                    <td scope="col"><?= session()->get('email') ?></td>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-center">
            <h2>Ganti Password</h2>
        </div>
    </div>
</div>
<hr>
<form action="/home/mhs/gantiPassword" method="post">
    <div class="row">
        <?php if (session()->has('errors')) : ?>
            <ul>
                <?php foreach (session('errors') as $error) : ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <div class="col-lg-12">
            <label for="passwordLama">Password Lama</label>
            <input id="passwordLama" type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="passwordLama">
        </div>
        <div class="col-lg-6">
            <label for="passwordBaru">Password Baru</label>
            <input id="passwordBaru" type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="passwordBaru">
        </div>
        <div class="col-lg-6">
            <label for="repasswordBaru">Input Ulang Password Baru</label>
            <input id="repasswordBaru" type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="repasswordBaru">
        </div>
        <div class="col-lg-12" style="margin-top: 15px;">
            <button type="submit" class="btn btn-primary">Ganti Password</button>
        </div>
    </div>
</form>



<!-- akhir edit history -->

<?= $this->endSection(); ?>