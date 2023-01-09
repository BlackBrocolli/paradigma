<?= $this->extend('/mahasiswa/templates/index'); ?>

<?= $this->section('page-content'); ?>

<!-- TOmbol baca ebook sementara -->
<a href="<?= base_url(); ?>/home/history/bacaebook">Baca ebook tekan disini, jangan dihapus dulu</a>
<br><br>

<!-- edit history disini -->


<!-- history buku -->
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-center">
                <h1>RIWAYAT PEMINJAMAN</h1>
            </div>
            <br>
            <div class="pull-left">
                <h2>Buku</h2>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12 margin-tb">
			<table class="table table-bordered">
		        <tr>
                    <th>Tanggal Pinjam</th>
		            <th>Tanggal Kembali</th>
		            <th>Judul Buku</th>
		            <th>Indeks Buku</th>
                    <th>Status</th>
		        </tr>
		        	
		        <tr>
		        	<td></td>
		            <td></td>
		            <td></td>
		            <td></td>
		        </tr>
		        
		    </table>
		</div>
	</div>

    <!-- history bagian ebook -->

    <div class="row">
        <div class="col-lg-12 margin-tb">
            
            <div class="pull-left">
                <h2>Ebook</h2>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12 margin-tb">
			<table class="table table-bordered">
		        <tr>
		            <th>Tanggal Pinjam</th>
		            <th>Tanggal Kembali</th>
		            <th>Judul Buku</th>
		            <th>Indeks Buku</th>
                    <th>Aksi</th>
		        </tr>
		        	
		        <tr>
		        	<td></td>
		            <td></td>
		            <td></td>
		            <td></td>
		        </tr>
		        
		    </table>
		</div>
	</div>


<!-- akhir edit history -->

<?= $this->endSection(); ?>