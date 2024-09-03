<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul_halaman ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
</head>
<body>
    <div class="container mt-5">
        <h1><?= $judul_halaman ?></h1>
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
                <?php $no = 1; foreach ($koleksi as $item): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $item['judul'] ?></td>
                    <td><?= $item['nama_kategori'] ?></td>
                    <td><?= $item['deskripsi'] ?></td>
                    <td><img src="<?= base_url('assets/upload/buku/' . $item['foto']) ?>" alt="<?= $item['judul'] ?>" style="width: 100px; height: auto;"></td>
                    <td>
                        <a href="<?= base_url('peminjaman/hapus_dari_koleksi/' . $item['id_koleksi']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus buku ini dari koleksi?');">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>


<script>
    $('#menghilang').delay('slow').slideDown('slow').delay(2000).slideUp(600);
</script>
