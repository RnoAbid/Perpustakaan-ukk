<div id="menghilang" class="">
    <?php echo $this->session->flashdata('alert', true) ?>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Table Siswa</h4>
                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModalsiswa">
                    <i class="fa fa-plus"></i>
                    Tambah Data Siswa
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Modal Tambah -->
            <div class="modal fade" id="addRowModalsiswa" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title">
                                <span class="fw-mediumbold"> Tambah</span>
                                <span class="fw-light">Data Siswa</span>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formTambahBuku" class="mb-3" action="<?= base_url('siswa/tambah') ?>" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nis" class="form-label">NIS</label>
                                    <input type="text" class="form-control" id="nis" name="nis" placeholder="NIS" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="textarea" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Tanggal lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tahunterbit" name="tanggal_lahir" placeholder="Tahun Terbit Buku" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Foto</label>
                                    <input type="file" name="foto" class="form-control" accept="image/png,image/jpeg,image/jpg">
                                </div>

                                <div class="modal-footer border-0">
                                    <button type="submit" id="addRowButton" class="btn btn-primary">
                                        Tambah
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
                                        <th>Nama Siswa</th>
                                        <th>NIS</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Alamat</th>
                                        <th>Foto</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($siswa as $ii) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $ii['nama'] ?></td>
                                            <td><?= $ii['nis'] ?></td>
                                            <td><?= $ii['tanggal_lahir'] ?></td>
                                            <td><?= $ii['alamat'] ?></td>
                                            <td>
                                                <a href="<?= base_url('assets/siswa/' . $ii['foto']) ?>" target="_blank">
                                                    <i class="ficon ft-search"></i>Lihat Foto
                                                </a>
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a class="btn btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus data ini?')" href="<?= base_url('siswa/hapus/' . $ii['id_siswa']) ?>">Delete</a>
                                                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditRowModalsiswa<?= $ii['id_siswa']; ?>">
                                                        <i class="fa fa-plus"></i>Edit
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="EditRowModalsiswa<?= $ii['id_siswa']; ?>" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header border-0">
                                                        <h5 class="modal-title">
                                                            <span class="fw-mediumbold">Edit</span>
                                                            <span class="fw-light">Data Siswa</span>
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="formeditBuku" class="mb-3" action="<?= base_url('siswa/edit/') ?>" method="post">
                                                            <div class="mb-3">
                                                                <label for="nama" class="form-label">Nama</label>
                                                                <input value="<?= $ii['nama'] ?>" type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="nis" class="form-label">NIS</label>
                                                                <input value="<?= $ii['nis'] ?>" type="text" class="form-control" id="nis" name="nis" placeholder="NIS" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                                                <input value="<?= $ii['tanggal_lahir'] ?>" type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="alamat" class="form-label">Alamat</label>
                                                                <input value="<?= $ii['alamat'] ?>" type="textarea" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleFormControlFile1">Foto</label>
                                                                <input type="file" name="foto" class="form-control" accept="image/png,image/jpeg,image/jpg">
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