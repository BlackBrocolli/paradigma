<?= $this->extend('/mahasiswa/templates/index'); ?>

<?= $this->section('page-content'); ?>

<!-- Baca ebook edit disini -->
    <h4><?= $judulEbook ?> : </h4> <br>
    <center>
        <embed type="application/pdf" src="/file_ebook/<?= $ebook ?>#toolbar=0" width="70%" height="800"></embed>
    </center>
<!-- akhir baca ebook -->

<?= $this->endSection(); ?>