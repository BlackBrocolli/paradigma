<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Buku</h6>
        </div>
        <div class="card-body">

            <!-- tombol tambah anggota -->
            <a href="<?= base_url(); ?>/home/addbuku" class="btn btn-primary">Tambah buku</a>
            <br><br>

            <form action="/home/buku" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search by Book Name or Book ID" aria-label="Recipient's username" aria-describedby="button-addon2" name="cari">
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
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Stok</th>

                    <!-- tampilkan hanya jika levelnya admin -->
                    <?php if (session()->get('level') == 'admin') : ?>
                        <th>Action</th>
                    <?php endif; ?>

                </tr>
                <?php
                $no = 1;
                foreach ($buku as $row) : ?>
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td><?php echo $row->judul; ?></td>
                        <td><?php echo $row->penulis; ?></td>
                        <td><?php echo $row->penerbit; ?></td>
                        <td><?php echo $row->stok; ?></td>
                        <!-- tampilkan hanya jika levelnya admin -->
                        <?php if (session()->get('level') == 'admin') : ?>
                            <td>
                                <a title="Update" class="btn btn-warning" href="<?= base_url(); ?>/home/editbuku/<?= $row->id_buku; ?>"><i class="fas fa-fw fa-pen"></i></a>
                                <a title="Delete" class="btn btn-danger" href="<?= base_url(); ?>/home/deletebuku/<?= $row->id_buku; ?>"><i class="fas fa-fw fa-trash"></i></a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
            <!-- end of Tabel buku -->

            <?= $pager->links() ?>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>