<div id="menghilang" class="">
    <?php echo $this->session->flashdata('alert', true) ?>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Table Ulasan Buku</h4>
                
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
                                    <th rowspan="1" colspan="1">User</th>
                                    <th rowspan="1" colspan="1">Ulasan</th>
                                    <th rowspan="1" colspan="1">Rating</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1;
                                foreach ($ulasan as $ii) { ?>
                                    <tr>

                                        <td role="row" class="odd">
                                            <?= $no++; ?>
                                        </td>
                                        <td role="row" class="even">
                                            <?= $ii['nama'] ?>
                                        </td>
                                        <td role="row" class="even">
                                            <?= $ii['ulasan'] ?>
                                        </td>
                                        <td role="row" class="even">
                                            <?= $ii['rating'] ?> ⭐
                                        </td>
                                        

                                     
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
    $('#menghilang').delay('slow').slideDown('slow').delay(2000).slideUp(600);
</script>