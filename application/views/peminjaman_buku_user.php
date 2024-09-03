<div id="menghilang">
    <?= $this->session->flashdata('alert', true) ?>
</div>





<div class="card">
    <h5 class="card-header">Data Peminjaman</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr class="text-nowrap">
                    <th>#</th>
                    <th>Kode Peminjaman</th>
                    <th>Nama Peminjam</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Batas Peminjaman</th>
                    <th>Status Peminjaman</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($pinjam as $u): ?>
                    <tr>
                        <td><?= $no++  ?></td>
                        <td><?= $u['kode']  ?></td>
                        <td><?= $u['nama']  ?></td>
                        <td><?= $u['tanggal_awal']  ?></td>
                        <td><?= $u['tanggal_akhir']  ?></td>
                        <td>
                            <div class="badge bg-<?= $u['status'] == 'Belum Selesai' ? 'warning' : 'success' ?>">
                                <?= $u['status'] ?>
                            </div>
                        </td>
                   
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
   