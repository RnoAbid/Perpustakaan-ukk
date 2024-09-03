<section class="ftco-section">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 product-details pl-md-5 ftco-animate fadeInUp ftco-animated">

                <div class="row">
                    <!-- Bagian pemilihan buku -->
                    <div class="col-md-12 mb-3">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Pilih Buku Apa Saja yang Akan Dipinjam</h5>
                                <small class="text-muted">(Pastikan buku yang dipilih benar)</small>
                            </div>
                            <div class="card-body">
                                <?php foreach ($buku as $b) { ?>

                                    <form action="<?= base_url('peminjaman/tambah_pinjam') ?>" method="post">
                                        <div class="form-group">
                                            <label class="form-label" for="id_user">Nama User</label>
                                            <input type="text" class="form-control" placeholder="<?= $this->session->userdata('nama') ?>" readonly>
                                            <input type="hidden" class="form-control" name="id_user" value="<?= $this->session->userdata('id_user') ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group d-flex">
                                                <div class="select-wrap">
                                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                                    <input type="hidden" class="form-control" name="id_buku" value="<?= $b['id_buku'] ?>">

                                                    <select name="id_buku" id="" class="form-control select-wrap">
                                                        <?php foreach ($buku as $aa) { ?>
                                                            <option value="<?= $aa['id_buku']; ?>" <?= $aa['stok'] == 0 ? 'disabled' : ''; ?>><?= $aa['judul']; ?>(<?= $aa['stok']; ?>)</option>
                                                        <?php } ?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- <div class="form-group">
                                            <label class="form-label" for="id_user">Buku</label>
                                            <input type="text" class="form-control" placeholder="<?= $b['judul'] ?>" readonly>
                                            <select name="id_buku" type="text">
                                                <?php foreach ($produk as $aa) { ?>
                                                    <option value=" <?= $aa['id_produk'] ?>"><?= $aa['nama'] ?> - <?= $aa['kode_produk'] ?>(<?= $aa['stok'] ?>)"></option>
                                                <?php } ?>
                                            </select>
                                        </div> -->

                                        <div class="form-group">
                                            <label class="form-label" for="id_user">Tanggal Peminjaman</label>
                                            <input class="form-control" type="date" name="tanggal_peminjaman">
                                        </div>
                                        <div>

                                            <button type="submit" class="btn btn-black  py-3 rounded-pill">Tambah Keranjang</button>
                                        </div>
                                    </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

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
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($detail as $item): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $item['judul'] ?></td>
                                        <td><?= $item['kategori'] ?></td>
                                        <td><?= $item['deskripsi'] ?></td>
                                        <td><img src="<?= base_url('assets/upload/buku/' . $item['foto']) ?>" alt="<?= $item['judul'] ?>" style="width: 100px; height: auto;"></td>
                                        <td>
                                        <a id="btn-hapus" class="btn btn-danger btn-sm" href="<?= base_url('peminjaman/hpstemp/' . $value->id_temp); ?>"><i class="bx bx-trash me-1"></i>Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
                </body>

                </html>


</section>