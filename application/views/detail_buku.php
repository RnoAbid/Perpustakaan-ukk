<section class="ftco-section">
    <div id="menghilang" class="">
        <?php echo $this->session->flashdata('alert', true); ?>
    </div>
    <?php foreach ($buku as $b): ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate fadeInUp ftco-animated">
                    <a href="<?= base_url('assets/upload/buku/' . $b['foto']) ?>" class="image-popup prod-img-bg">
                        <img src="<?= base_url('assets/upload/buku/' . $b['foto']) ?>" class="img-fluid" alt="<?= $b['judul'] ?>">
                    </a>
                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate fadeInUp ftco-animated">
                    <h2><?= $b['judul'] ?></h2>
                    <h5><?= $b['kategori'] ?></h5>
                    <h6 class="mb-3"><?= $b['deskripsi'] ?></h6>
                    <p><?= isset($avg_ratings[$b['id_buku']]) ? number_format($avg_ratings[$b['id_buku']], 1) . '⭐' : 'Belum Memiliki Rating'; ?></p>
                    <br>
                    <form action="<?= base_url('peminjaman/tambah_koleksi') ?>" method="post">
                        <input type="hidden" name="id_user" value="<?= $this->session->userdata('id_user') ?>">
                        <input type="hidden" name="id_buku" value="<?= $b['id_buku'] ?>">
                        <!-- Uncomment the following lines if you need to add "Add to Cart" functionality -->
                        <!-- <?php if ($b['status'] == 'tersedia'): ?>
                            <a href="<?= base_url('dashboard_user/tampil_peminjaman/' . $b['id_buku']) ?>" class="btn btn-black py-3 px-5 mr-2"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
                        <?php else: ?>
                            <a class="btn btn-black py-3 px-5 mr-2">Sudah Dipinjam</a>
                        <?php endif; ?> -->
                        <span class="input-group-btn ml-2">
                            <button type="submit" class="quantity-right-plus btn" data-type="plus" data-field="">
                                <i class="ion-ios-bookmark"></i>
                            </button>
                        </span>
                    </form>
                    <br>
                    <a href="#" class="btn btn-black py-3 px-5 mr-2" data-bs-toggle="modal" data-bs-target="#reviewModal" 
                        data-book-id="<?= $b['id_buku'] ?>" data-book-title="<?= $b['judul'] ?>">
                        Add Ulasan
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</section>

<!-- Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Form Add Ulasan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('ulasan/AddUlasan/') ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label">Buku</label>
                        <input type="text" id="bookTitle" class="form-control" readonly>
                        <input type="hidden" id="bookId" name="id_buku">
                        <input type="hidden" name="id_user" value="<?= $this->session->userdata('id_user') ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ulasan Anda</label>
                        <textarea name="ulasan" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rating Anda</label>
                        <select name="rating" class="form-control">
                            <option value="1">⭐️</option>
                            <option value="2">⭐️⭐️</option>
                            <option value="3">⭐️⭐️⭐️</option>
                            <option value="4">⭐️⭐️⭐️⭐️</option>
                            <option value="5">⭐️⭐️⭐️⭐️⭐️</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var reviewModal = document.getElementById('reviewModal');
    reviewModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var bookId = button.getAttribute('data-book-id');
        var bookTitle = button.getAttribute('data-book-title');

        var bookTitleInput = reviewModal.querySelector('#bookTitle');
        var bookIdInput = reviewModal.querySelector('#bookId');

        bookTitleInput.value = bookTitle;
        bookIdInput.value = bookId;
    });
});
</script>
