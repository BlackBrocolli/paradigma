<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Copy Buku</h6>
        </div>
        <div class="card-body">
            <!-- tombol tambah anggota -->
            <a href="<?= base_url(); ?>/home/addcopybuku" class="btn btn-primary">Tambah Copy Buku</a>
            <br><br>

            <form action="/home/copy_buku" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search by Book Name or Book ID" aria-label="Search..." aria-describedby="button-addon2" name="cari">
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
                    <th>Indeks</th>
                    <th>Judul</th>
                    <th>Kondisi</th>
                    <th>ID Buku</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php
                $no = 1;
                foreach ($copy as $row) : ?>
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $row->indeks_buku; ?></td>
                        <td><?php echo $row->judul; ?></td>
                        <td><?php echo $row->kondisi; ?></td>
                        <td><?php echo $row->id_buku; ?></td>
                        <td><?php echo $row->status; ?></td>
                        <td>
                            <a title="Update" class="btn btn-warning" href="<?= base_url(); ?>/home/editcopybuku/<?= $row->indeks_buku; ?>"><i class="fas fa-fw fa-pen"></i></a>
                            <a title="Delete" class="btn btn-danger" href="<?= base_url(); ?>/home/deletecopybuku/<?= $row->indeks_buku; ?>"><i class="fas fa-fw fa-trash"></i></a>
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