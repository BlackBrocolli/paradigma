<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Ebook</h6>
        </div>
        <div class="card-body">
            <!-- tombol tambah anggota -->
            <a href="<?= base_url(); ?>/home/addebook" class="btn btn-primary">Tambah Ebook</a>
            <br><br>

            <form action="/home/ebook" method="get">
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
                    <th>Cover</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Halaman</th>
                    <th>Action</th>
                </tr>
                <?php
                $no = 1;
                foreach ($ebook as $row) : ?>
                    <tr>
                        <td><?php echo $nomor++; ?></td>
                        <td style="text-align: center"><img src="/cover_ebook/<?php echo $row->cover;?>" alt="" width="100"></td>
                        <td><?php echo $row->judul_ebook; ?></td>
                        <td><?php echo $row->penulis; ?></td>
                        <td><?php echo $row->halaman; ?></td>
                        <td>
                            <a title="Update" class="btn btn-warning" href="<?= base_url(); ?>/home/editebook/<?= $row->id_ebook; ?>"><i class="fas fa-fw fa-pen"></i></a>
                            <a title="Delete" class="btn btn-danger" href="<?= base_url(); ?>/home/deleteebook/<?= $row->id_ebook; ?>"><i class="fas fa-fw fa-trash"></i></a>
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