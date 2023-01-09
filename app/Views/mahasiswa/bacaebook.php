<?= $this->extend('/mahasiswa/templates/index'); ?>

<?= $this->section('page-content'); ?>

<!-- Baca ebook edit disini -->
    <h4>Judul Buku : </h4> <br><br><br>
    <center>
        <embed type="application/pdf" src="https://media.geeksforgeeks.org/wp-content/cdn-uploads/20210101201653/PDF.pdf#toolbar=0" width="1200" height="900"></embed>
    </center>
<!-- akhir baca ebook -->

<?= $this->endSection(); ?>