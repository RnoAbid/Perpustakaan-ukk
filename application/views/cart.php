<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
</head>
<body>
    <div class="container mt-5">
        <?php if ($this->session->flashdata('alert')): ?>
            <?= $this->session->flashdata('alert') ?>
        <?php endif; ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($cart as $item): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $item['judul'] ?></td>
                    <td><?= $item['kategori'] ?></td>
                    <td><?= $item['deskripsi'] ?></td>
                    <td><img src="<?= base_url('assets/upload/buku/' . $item['foto']) ?>" alt="<?= $item['judul'] ?>" style="width: 100px; height: auto;"></td>
                    <td>
                        <a href="<?= base_url('peminjaman/hapustemp/' . $item['id_temp']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus buku ini dari koleksi?');">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <form action="<?= base_url('peminjaman/tambah_pinjam')?>" method="post">
            <input type="date" name="tanggal_peminjaman" id="">
            <button type="submit">Tambah</button>
        </form>
    </div>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>
