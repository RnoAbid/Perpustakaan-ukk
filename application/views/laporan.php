<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LAPORAN </title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
	<div class="container mt-5">
		<div class="card m-3 p-2">
			<div class="nota">
				<div class="nota-header d-flex justify-content-center align-items-center">
					<div class="row">
						<h2>Laporan Peminjaman Buku E-Perpus</h2>
					</div>


				</div>
				<div class=" nota-header d-flex justify-content-center align-items-center">
					<p>Tanggal <?= $awal; ?> sampai <?= $akhir; ?><p>
				</div>
				<div class="nota-body mt-3">
					<table class="table table-responsive">
						<thead>
							<tr>
								<th>No</th>
								<th>Buku</th>
								<th>Nama</th>
								<th>Tanggal Peminjaman</th>
								<th>Tanggal Pengembalian</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
                            <?php $no=1; foreach($laporan as $a){  ?>
							<tr>
                                <td><?= $no; ?></td>
                                <td><?= $a['judul']  ?></td>
                                <td><?= $a['nama']  ?></td>
                                <td><?= $a['tanggal_peminjaman']  ?></td>
                                <td><?= $a['tanggal_pengembalian']  ?></td>
                                
                                <td><?php  if($a['status_peminjaman']=='proses'){  ?>
                                    Belum DiKembalikan
                                    <?php  }else{ ?>
                                        Sudah DiKembalikan
                                        <?php  } ?>
                                </td>
							</tr>
                            <?php $no++;}  ?>
						</tbody>

					</table>
				</div>
				<div class="nota-footer mt-3 d-flex justify-content-center align-items-center">
					<p>Terima kasih telah menggunakan layanan kami😆😆.</p>
				</div>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
	</script>
</body>

</html>