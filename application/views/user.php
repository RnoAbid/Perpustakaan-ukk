<div id="hilang" class="">
    <?php echo $this->session->flashdata('alert', true) ?>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Table User</h4>
                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModal">
                    <i class="fa fa-plus"></i>
                    Add User
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Modal -->
            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title">
                                <span class="fw-mediumbold"> Tambah</span>
                                <span class="fw-light"> User</span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form id="formAuthentication" class="mb-3" action="<?= base_url('dashboard/registrasi') ?>" method="post">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" autofocus / required>
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter your name" autofocus / required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" / required>
                                </div>
                                <div class="mb-3 form-password-toggle">
                                    <label class="form-label" for="password">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" / required>
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">NO Telephon</label>
                                    <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="Enter your telephon" / required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Adress</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Enter your adress" / required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Pilih Level</label>
                                    <select class="form-select" name="level" id="exampleFormControlSelect1">
                                        <option value="admin">Admin</option>
                                        <option value="petugas">Petugas</option>
                                        <option value="peminjam">Peminjam</option>


                                    </select>
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

            <div class="table-responsive">
                <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                    <div class="row">

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="add-row" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="add-row_info">
                                <thead>
                                    <tr role="row">
                                    <tr>
                                        <th>NO</th>
                                        <th rowspan="1" colspan="1">Name</th>
                                        <th rowspan="1" colspan="1">Username</th>
                                        <th rowspan="1" colspan="1">Email</th>
                                        <th rowspan="1" colspan="1">No Telp</th>
                                        <th rowspan="1" colspan="1">Alamat</th>
                                        <th rowspan="1" colspan="1">Level</th>
                                        <th rowspan="1" colspan="1">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $no = 1;
                                    foreach ($user as $ii) { ?>
                                        <tr>

                                            <td role="row" class="odd">
                                                <?= $no++; ?>
                                            </td>
                                            <td role="row" class="even">
                                                <?= $ii['nama'] ?>
                                            </td>
                                            <td role="row" class="odd">
                                                <?= $ii['username'] ?>
                                            </td>
                                            <td role="row" class="even">
                                                <?= $ii['email'] ?>
                                            </td>
                                            <td role="row" class="odd">
                                                <?= $ii['no_telepon'] ?>
                                            </td>
                                            <td role="row" class="odd">
                                                <?= $ii['alamat'] ?>
                                            </td>
                                            <td role="row" class="odd">
                                                <?= $ii['level'] ?>
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a class="btn btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus data ini??')" href="<?= base_url('user/hapus/' . $ii['id_user']) ?>">Delete</a>
                                                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $ii['id_user']; ?>">
                                                        <i class="fa fa-plus"></i>Edit
                                                    </a>
                                                </div>
                                            </td>
                                            <!-- Modal -->
                                            <div class="modal fade" id="editModal<?= $ii['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Perbarui User</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="<?= base_url('user/edit') ?>" method="post">
                                                                <input type="hidden" name="id_user" value="<?= $ii['id_user'] ?>">
                                                                <div class="row mb-3">
                                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Username</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" name="username" class="form-control" value="<?= $ii['username'] ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Nama</label>
                                                                    <div class="col-sm-10">
                                                                        <input name="nama" type="text" class="form-control" value="<?= $ii['nama'] ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Email</label>
                                                                    <div class="col-sm-10">
                                                                        <input name="email" type="text" class="form-control" value="<?= $ii['email'] ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label for="inputPassword3" class="col-sm-3 col-form-label">NO Telepon</label>
                                                                    <div class="col-sm-10">
                                                                        <input name="no_telepon" type="text" class="form-control" value="<?= $ii['no_telepon'] ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Alamat</label>
                                                                    <div class="col-sm-10">
                                                                        <input name="alamat" type="text" class="form-control" value="<?= $ii['alamat'] ?>">
                                                                    </div>
                                                                </div>

                                                                <button type="submit" class="btn btn-primary">Perbarui</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
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
    $('#hilang').delay('slow').slideDown('slow').delay(2000).slideUp(600);
</script>