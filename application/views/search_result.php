<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul_halaman ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>"> <!-- Gaya CSS tambahan -->
</head>
<body>
    <h1><?= $judul_halaman ?></h1>
    <div class="search-results">
        <?php if (!empty($buku)): ?>
            <div class="container">
                <div class="row">
                    <?php foreach ($buku as $uu): ?>
                        <div class="col-sm-12 col-md-6 col-lg-3 ftco-animate d-flex">
                            <div class="product d-flex flex-column">
                                <a href="<?= base_url('dashboard_user/detail/' . $uu['id_buku']) ?>" class="img-prod">
                                    <img class="img-fluid" src="<?= base_url('assets/upload/buku/' . $uu['foto']) ?>" alt="<?= $uu['judul'] ?>">
                                    <div class="overlay"></div>
                                </a>
                                <div class="text py-3 pb-4 px-3">
                                    <div class="d-flex">
                                        <div class="cat">
                                            <span><?= $uu['kategori'] ?></span>
                                        </div>
                                    </div>
                                    <h3><a href="<?= base_url('dashboard_user/detail/' . $uu['id_buku']) ?>"><?= $uu['judul'] ?></a></h3>
                                    <div class="pricing">
                                        <!-- <p class="price"><span>Rp. <?= number_format($uu['harga']) ?></span></p> -->
                                    </div>
                                    <p class="bottom-area d-flex px-3">
                                        <a href="<?= base_url('peminjaman') ?>" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
                                        <a href="<?= base_url('dashboard_user/detail/' . $uu['id_buku']) ?>" class="buy-now text-center py-2">Detail<span><i class="ion-ios-cart ml-1"></i></span></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <p>Tidak ada hasil yang ditemukan untuk pencarian: <?= htmlspecialchars($query) ?></p>
        <?php endif; ?>
    </div>
    <script>
        $('#menghilang').delay('slow').slideDown('slow').delay(2000).slideUp(600);
    </script>
</body>
</html>
