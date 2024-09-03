<div id="menghilang" class="">
    <?php echo $this->session->flashdata('alert', true) ?>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Table Kategori Buku</h4>
                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModal">
                    <i class="fa fa-plus"></i>
                    Tambah Kategori Buku
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Modal Tambah -->
            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title">
                                <span class="fw-mediumbold"> Tambah</span>
                                <span class="fw-light"> Kategori Buku</span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="formAuthentication" class="mb-3" action="<?= base_url('kategori/tambah') ?>" method="post">
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukkan Kategori" autofocus required>
                                </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="submit" id="addRowButton" class="btn btn-primary">
                                Add
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                Close
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
                    <!-- Filter and Search if needed -->
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="add-row" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="add-row_info">
                            <thead>
                                <tr role="row">
                                    <th>NO</th>
                                    <th>Kategori Buku</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1;
                                foreach ($kategori as $ii) { ?>
                                    <tr>
                                        <td role="row" class="odd"><?= $no++; ?></td>
                                        <td role="row" class="even"><?= $ii['kategori'] ?></td>
                                        <td>
                                            <div class="form-button-action">
                                                <a class="btn btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus data ini?')" href="<?= base_url('kategori/hapus/' . $ii['id_kategori']); ?>">Delete</a>
                                                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditkateModal<?= $ii['id_kategori']; ?>">
                                                    <i class="fa fa-edit"></i>Edit
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="EditkateModal<?= $ii['id_kategori']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title">
                                                        <span class="fw-mediumbold"> Edit</span>
                                                        <span class="fw-light"> Kategori Buku</span>
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="formAuthentication" class="mb-3" action="<?= base_url('kategori/update') ?>" method="post">
                                                        <input type="hidden" name="id_kategori" value="<?= $ii['id_kategori']; ?>">
                                                        <div class="mb-3">
                                                            <label for="kategori" class="form-label">Kategori</label>
                                                            <input type="text" class="form-control" id="kategori" name="kategori" value="<?= $ii['kategori'] ?>" placeholder="Masukkan Kategori" autofocus required>
                                                        </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="submit" id="updateRowButton" class="btn btn-primary">
                                                        Update
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                </div>
                                                </form>
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

<script>
    $('#menghilang').delay('slow').slideDown('slow').delay(2000).slideUp(600);
</script>