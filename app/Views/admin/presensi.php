<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Presensi Mahasiswa</h6>
        </div>
        <div class="card-body">
            <!-- tombol tambah anggota -->

            <!-- tampilkan info jika ada -->
            <?php if (!empty(session()->getFlashdata('info'))) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?php echo session()->getFlashdata('info'); ?>
                </div>
            <?php endif; ?>
            <table border="0" cellspacing="5" cellpadding="5">
                <tbody>
                    <tr>
                        <td>Minimum date:</td>
                        <td><input type="text" id="min" name="min"></td>
                    </tr>
                    <tr>
                        <td>Maximum date:</td>
                        <td><input type="text" id="max" name="max"></td>
                    </tr>
                </tbody>
            </table>
            <table id="example" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>NRP</th>
                        <th>Nama</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($presensi as $row) : ?>
                    <tr>
                        <td><?= $row->tanggal_datang ?></td>
                        <td><?= $row->nrp ?></td>
                        <td><?= $row->nama ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Tanggal</th>
                        <th>NRP</th>
                        <th>Nama</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>