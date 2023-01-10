<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Reservasi</h6>
        </div>
        <div class="card-body">
            <!-- tampilkan info jika ada -->
            <?php if (!empty(session()->getFlashdata('info'))) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?php echo session()->getFlashdata('info'); ?>
                </div>
            <?php endif; ?>

            <!-- Tabel reservasi -->
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
                        <th>Tanggal Reservasi</th>
                        <th>NRP</th>
                        <th>Indeks</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($reservasi as $row) : ?>
                    <tr>
                        <td><?php echo $row->tanggal_reservasi; ?></td>
                        <td><?php echo $row->nrp; ?></td>
                        <td><?php echo $row->indeks_buku; ?></td>
                        <td id="status"><?php echo $row->status; ?></td>
                        <td>
                            <?php if ($row->status == 'menunggu...') : ?>
                                <a title="Reservasi selesai" class="btn btn-success" href="<?= base_url(); ?>/home/reservasi/selesai/<?= $row->nrp; ?>/<?= $row->indeks_buku; ?>/<?= $row->id_reservasi; ?>"><i class="fas fa-fw fa-check" style="margin: -4px"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Tanggal Reservasi</th>
                        <th>NRP</th>
                        <th>Indeks</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>