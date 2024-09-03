<div id="menghilang" class="">
    <?php echo $this->session->flashdata('alert', true) ?>
</div>

<div class="container-fluid service py-5 ">
    <div class="container py-5">
        <?php if (!empty($buku)) : ?>
            <div class="row">
                <?php foreach ($buku as $uu) : ?>
                    <div class="col-md-3 col-lg-3 wow fadeInUp " data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="<?= base_url('assets/upload/buku/' . $uu['foto']) ?>" class="img-fluid rounded-top w-100" alt="">
                            </div>
                            <div class="service-content p-4">
                                <div class="service-content-inner">
                                    <a href="<?= base_url('dashboard_user/detail_buku/' . $uu['id_buku']) ?>" class="d-inline-block h4 mb-4"><?= $uu['judul'] ?></a>
                                    <h5><?= $uu['kategori'] ?></h5>
                                    <!-- <h6>Rating :</h6><?= isset($avg_ratings[$uu['id_buku']]) ? number_format($avg_ratings[$uu['id_buku']], 1) . '⭐' : 'Belum Memiliki Rating'; ?> -->

                                    <div class="d-flex text-primary mb-3">
                                        <?php
                                        $rating = isset($avg_ratings[$uu['id_buku']]) ? number_format($avg_ratings[$uu['id_buku']], 1) : 0;
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $rating) {
                                                echo '<i class="fas fa-star"></i>';
                                            } else {
                                                echo '<i class="fas fa-star text-body"></i>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <p class="mb-4"><?= $uu['deskripsi'] ?></p>
                                    <a class="btn btn-primary rounded-pill py-2 px-4" href="<?= base_url('dashboard_user/detail_buku/' . $uu['id_buku']) ?>">Detail</a>
                                    <br>
                                    <br>
                                    <form action="<?= base_url('peminjaman/addcart') ?>" method="post">
                                        <input type="hidden" name="id_buku" value="<?= $uu['id_buku'] ?>">
                                        <button class="btn btn-primary rounded-pill py-2 px-4" type="submit">Pinjam</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    $('#menghilang').delay('slow').slideDown('slow').delay(2000).slideUp(600);
</script>