<?= $this->extend('/mahasiswa/templates/index'); ?>

<?= $this->section('page-content'); ?>

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
            <table id="example" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
						<th>Tanggal Pinjam</th>
						<th>Tanggal Kembali</th>
						<th>Tanggal Dikembalikan</th>
						<th>Judul Buku</th>
						<th>Indeks Buku</th>
						<th>Status</th>
                    </tr>
                </thead>
                <tbody>                    
					<?php foreach($peminjaman as $dataPeminjaman) : ?>
						<tr>
							<td><?= $dataPeminjaman->tanggal_pinjam ?></td>
							<td><?= $dataPeminjaman->tanggal_estimasi_kembali ?></td>
							<td><?= $dataPeminjaman->tanggal_kembali ?></td>
							<td><?= $dataPeminjaman->judul ?></td>
							<td><?= $dataPeminjaman->indeks_buku ?></td>
							<td><?= ucfirst($dataPeminjaman->status) ?></td>
						</tr>
					<?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
						<th>Tanggal Pinjam</th>
						<th>Tanggal Kembali</th>
						<th>Tanggal Dikembalikan</th>
						<th>Judul Buku</th>
						<th>Indeks Buku</th>
						<th>Status</th>
                    </tr>
                </tfoot>
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
		<table id="example2" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
						<th>Tanggal Pinjam</th>
						<th>Tanggal Selesai Pinjam</th>
						<th>Judul Ebook</th>
						<th>Status</th>
						<th>Aksi</th>
                    </tr>
                </thead>
                <tbody>                    
					<?php foreach($pinjam_ebook as $dataPinjamEbook) : ?>
						<tr>
							<td><?= $dataPinjamEbook->tanggal_pinjam ?></td>
							<td><?= $dataPinjamEbook->tanggal_selesai ?></td>
							<td><?= $dataPinjamEbook->judul_ebook ?></td>
							<td><?php if(date('Y-m-d') < $dataPinjamEbook->tanggal_selesai){ echo "Dalam Peminjaman"; }else{ echo "Selesai"; } ?></td>
							<td><?php if(date('Y-m-d') < $dataPinjamEbook->tanggal_selesai) : ?> <form action="/home/mhs/bacaebook/<?= $dataPinjamEbook->id_peminjaman ?>" method="get"><button type="submit" class="btn btn-primary">Baca</button></form><?php else :  ?>Peminjaman Selesai<?php endif; ?></td>
						</tr>
					<?php endforeach; ?>                
                </tbody>
                <tfoot>
                    <tr>
						<th>Tanggal Pinjam</th>
						<th>Tanggal Selesai Pinjam</th>
						<th>Judul Ebook</th>
						<th>Status</th>
						<th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
		</div>
	</div>


<!-- akhir edit history -->

<?= $this->endSection(); ?>