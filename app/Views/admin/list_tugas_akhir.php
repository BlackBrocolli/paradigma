<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Tugas Akhir</h6>
        </div>
        <div class="card-body">
            <!-- tombol tambah tugasakhir -->
            <a href="<?= base_url(); ?>/home/addtugasakhir" class="btn btn-primary">Tambah Tugas Akhir</a>
            <br><br>

            <form action="/home/tugasakhir" method="get">
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

            <!-- Tabel buku -->
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Indeks TA</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun</th>
                    <th>Action</th>
                </tr>
                <?php
                $no = 1;
                foreach ($tugasakhir as $row) : ?>
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td style="text-align: center"><?= $row->indeks; ?></td>
                        <td><?php echo $row->judul; ?></td>
                        <td><?php echo $row->nama." - ".$row->nrp; ?></td>
                        <td><?php echo $row->tahun; ?></td>
                        <td>
                            <a title="Update" class="btn btn-warning" href="<?= base_url(); ?>/home/edittugasakhir/<?= $row->indeks; ?>"><i class="fas fa-fw fa-pen"></i></a>
                            <a title="Delete" class="btn btn-danger" href="<?= base_url(); ?>/home/deletetugasakhir/<?= $row->indeks; ?>"><i class="fas fa-fw fa-trash"></i></a>
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