<div id="menghilang" class="">
    <?php echo $this->session->flashdata('alert', true) ?>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Table Buku</h4>
                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModal">
                    <i class="fa fa-plus"></i>
                    Tambah Data Buku
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Modal Tambah -->
            <div class="modal fade" id="addRowModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title">
                                <span class="fw-mediumbold"> Tambah</span>
                                <span class="fw-light"> Buku</span>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formTambahBuku" class="mb-3" action="<?= base_url('buku/tambah') ?>" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" required>
                                </div>
                                <div class="mb-3">
                                    <label for="penulis" class="form-label">Penulis</label>
                                    <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Nama Penulis" required>
                                </div>
                                <div class="mb-3">
                                    <label for="penerbit" class="form-label">Penerbit</label>
                                    <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Nama Penerbit" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tahunterbit" class="form-label">Tahun Terbit</label>
                                    <input type="text" class="form-control" id="tahunterbit" name="tahunterbit" placeholder="Tahun Terbit Buku" required>
                                </div>
                                <div class="mb-3">
                                    <label for="stok" class="form-label">Jumlah Stok</label>
                                    <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok Buku" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi Buku" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Foto</label>
                                    <input type="file" name="foto" class="form-control" accept="image/png,image/jpeg,image/jpg">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Pilih Kategori</label>
                                    <select class="form-select" name="id_kategori" id="exampleFormControlSelect1">
                                        <?php foreach ($kategori as $aa) { ?>
                                            <option value="<?= $aa['id_kategori'] ?>"> <?= $aa['kategori'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="submit" id="addRowButton" class="btn btn-primary">
                                        Add
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="add-row" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="add-row_info">
                                <thead>
                                    <tr role="row">
                                        <th>NO</th>
                                        <th>Judul Buku</th>
                                        <th>Penulis</th>
                                        <th>Penerbit</th>
                                        <th>Tahun Terbit</th>
                                        <th>Stok</th>
                                        <th>Kategori</th>
                                        <th>Deskripsi</th>
                                        <th>Rating</th>
                                        <th>Foto</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($buku as $ii) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $ii['judul'] ?></td>
                                            <td><?= $ii['penulis'] ?></td>
                                            <td><?= $ii['penerbit'] ?></td>
                                            <td><?= $ii['tahunterbit'] ?></td>
                                            <td><?= $ii['stok'] ?></td>
                                            <td><?= $ii['kategori'] ?></td>
                                            <td><?= $ii['deskripsi'] ?></td>
                                            <td><?=isset($avg_ratings[ $ii['id_buku']]) ? number_format($avg_ratings[ $ii['id_buku']],1). '⭐' : 'Belum Memiliki Rating';?></td>
                                            <td>
                                                <a href="<?= base_url('assets/upload/buku/' . $ii['foto']) ?>" target="_blank">
                                                    <i class="ficon ft-search"></i>Lihat Foto
                                                </a>
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a class="btn btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus data ini?')" href="<?= base_url('buku/hapus/' . $ii['id_buku']) ?>">Delete</a>
                                                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditRowModal<?= $ii['id_buku']; ?>">
                                                        <i class="fa fa-plus"></i>Edit
                                                    </a>
                                                    <a class="btn btn-success" href="<?= base_url('buku/ulasan/') . $ii['id_buku']; ?>">
                                                        <i class="fa fa-plus"></i>Ulasan
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="EditRowModal<?= $ii['id_buku']; ?>" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header border-0">
                                                        <h5 class="modal-title">
                                                            <span class="fw-mediumbold">Edit</span>
                                                            <span class="fw-light"> Buku</span>
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="formeditBuku" class="mb-3" action="<?= base_url('buku/edit') ?>" method="post" enctype="multipart/form-data">
                                                            <input type="hidden" name="id_buku" value="<?= $ii['id_buku'] ?>">
                                                            <input type="hidden" name="foto_lama" value="<?= $ii['foto'] ?>"> <!-- Tambahkan ini -->
                                                            ...

                                                            <div class="mb-3">
                                                                <label for="judul" class="form-label">Judul</label>
                                                                <input value="<?= $ii['judul'] ?>" type="text" class="form-control" id="judul" name="judul" placeholder="Judul" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="penulis" class="form-label">Penulis</label>
                                                                <input value="<?= $ii['penulis'] ?>" type="text" class="form-control" id="penulis" name="penulis" placeholder="Nama Penulis" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="penerbit" class="form-label">Penerbit</label>
                                                                <input value="<?= $ii['penerbit'] ?>" type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Nama Penerbit" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="tahunterbit" class="form-label">Tahun Terbit</label>
                                                                <input value="<?= $ii['tahunterbit'] ?>" type="text" class="form-control" id="tahunterbit" name="tahunterbit" placeholder="Tahun Terbit Buku" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="stok" class="form-label">Jumlah Stok</label>
                                                                <input value="<?= $ii['stok'] ?>" type="number" class="form-control" id="stok" name="stok" placeholder="Stok Buku" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                                                <textarea value="<?= $ii['deskripsi'] ?>" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi Buku" required></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleFormControlFile1">Foto</label>
                                                                <input type="file" name="foto" class="form-control" accept="image/png,image/jpeg,image/jpg">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleFormControlSelect1">Pilih Kategori</label>
                                                                <select class="form-select" name="id_kategori" id="exampleFormControlSelect1">
                                                                    <?php foreach ($kategori as $aa) { ?>
                                                                        <option value="<?= $aa['id_kategori'] ?>" <?= $aa['id_kategori'] == $ii['id_kategori'] ? 'selected' : '' ?>><?= $aa['kategori'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer border-0">
                                                                <button type="submit" id="addRowButton" class="btn btn-primary">Edit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $('#menghilang').delay('slow').slideDown('slow').delay(2000).slideUp(600);
</script>