<?= $this->extend('/mahasiswa/templates/index'); ?>

<?= $this->section('page-content'); ?>

<!-- TOmbol baca ebook sementara -->
<a href="<?= base_url(); ?>/home/history/bacaebook">Baca ebook tekan disini, jangan dihapus dulu</a>
<br><br>

<!-- edit history disini -->
History
<!-- akhir edit history -->

<?= $this->endSection(); ?>