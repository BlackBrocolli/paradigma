<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Reservasi</h6>
        </div>
        <div class="card-body">

            <form action="/home/reservasi" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="button-addon2" name="cari">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
                </div>
            </form>

            <!-- tampilkan info jika ada -->
            <?php if (!empty(session()->getFlashdata('info'))) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?php echo session()->getFlashdata('info'); ?>
                </div>
            <?php endif; ?>

            <!-- Tabel reservasi -->
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Tanggal Reservasi</th>
                    <th>NRP</th>
                    <th>Indeks</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php
                $no = 1;
                foreach ($reservasi as $row) : ?>
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $row->tanggal_reservasi; ?></td>
                        <td><?php echo $row->nrp; ?></td>
                        <td><?php echo $row->indeks_buku; ?></td>
                        <td id="status"><?php echo $row->status; ?></td>
                        <td>
                            <?php if ($row->status == 'menunggu...') : ?>
                                <a title="Reservasi selesai" class="btn btn-success" href="<?= base_url(); ?>/home/editreservasi/<?= $row->id_reservasi; ?>"><i class="fas fa-fw fa-check" style="margin: -4px"></i></a>
                            <?php endif; ?>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </table>
            <!-- end of Tabel reservasi -->

            <?= $pager->links() ?>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>