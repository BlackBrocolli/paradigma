<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Mahasiswa</h6>
        </div>
        <div class="card-body">

            <!-- tombol tambah anggota -->
            <a href="<?= base_url(); ?>/home/addanggota" class="btn btn-primary">Tambah Mahasiswa</a>
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
                    <th>Nama Mahasiswa</th>
                    <th>Prodi</th>
                    <th>Angkatan</th>
                    <th>Action</th>
                </tr>
                <?php
                $no = 1;
                foreach ($anggota as $row) : ?>
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $row->nrp; ?></td>
                        <td><?php echo $row->nama; ?></td>
                        <td><?php echo $row->prodi; ?></td>
                        <td><?php echo $row->angkatan; ?></td>
                        <td>
                            <a title="Update" class="btn btn-warning" href="<?= base_url(); ?>/home/editanggota/<?= $row->nrp; ?>"><i class="fas fa-fw fa-pen"></i></a>
                            <a title="Delete" class="btn btn-danger" href="<?= base_url(); ?>/home/deleteanggota/<?= $row->nrp; ?>"><i class="fas fa-fw fa-trash"></i></a>
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