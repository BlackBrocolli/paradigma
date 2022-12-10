<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Peminjaman</h6>
        </div>
        <div class="card-body">

            <!-- tombol tambah peminjaman -->
            <a href="<?= base_url(); ?>/home/addpeminjaman" class="btn btn-primary">Tambah Peminjaman</a>
            <br><br>

            <!-- tampilkan info jika ada -->
            <?php if (!empty(session()->getFlashdata('info'))) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?php echo session()->getFlashdata('info'); ?>
                </div>
            <?php endif; ?>

            <!-- Tabel buku -->
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>NRP</th>
                    <th>Nama mahasiswa</th>
                    <th>Indeks</th>
                    <th>Judul</th>
                    <th>Tanggal pinjam</th>
                    <th>Estimasi kembali</th>
                    <th>Tanggal kembali</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php
                $no = 1;
                foreach ($pinjam as $row) : ?>
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $row->nrp; ?></td>
                        <td><?php echo $row->nama; ?></td>
                        <td><?php echo $row->indeks_buku; ?></td>
                        <td><?php echo $row->judul; ?></td>
                        <td><?php echo $row->tanggal_pinjam; ?></td>
                        <td><?php echo $row->tanggal_estimasi_kembali; ?></td>
                        <td><?php echo $row->tanggal_kembali; ?></td>
                        <td id="status"><?php echo $row->status; ?></td>
                        <td>
                            <?php if ($row->status == 'ongoing' || $row->status == 'overdue') : ?>
                                <?php if ($row->status !== 'overdue') : ?>
                                    <a title="Tambah waktu pinjam" class="btn btn-warning" href="<?= base_url(); ?>/home/updatetanggal/<?= $row->id_peminjaman; ?>/<?= $row->indeks_buku; ?>"><i class="fas fa-fw fa-calendar-plus" style="margin: -4px"></i></a>
                                <?php endif; ?>
                                <a title="Peminjaman selesai" class="btn btn-success" href="<?= base_url(); ?>/home/editstatus/<?= $row->id_peminjaman; ?>/<?= $row->indeks_buku; ?>"><i class="fas fa-fw fa-check" style="margin: -4px"></i></a>
                            <?php endif; ?>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </table>
            <!-- end of Tabel buku -->

            <?= $pager->links() ?>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>