<?php foreach ($buku as $p): ?>
    <!-- Modal for adding reviews -->
    <div class="modal fade" id="reviewModal<?= $p['id_buku'] ?>" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
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
                            <input type="text" class="form-control" value="<?= $p['judul'] ?>" readonly>
                            <input type="hidden" name="id_buku" value="<?= $p['id_buku'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ulasan Anda</label>
                            <textarea name="ulasan" class="form-control"></textarea>
                            <input type="hidden" name="id_user" value="<?= $this->session->userdata('id_user') ?>">
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

    <!-- Button to trigger modal -->
    <a href="#" class="btn btn-black py-3 px-5 mr-2" data-bs-toggle="modal" data-bs-target="#reviewModal<?= $p['id_buku'] ?>">Add Ulasan</a>
<?php endforeach; ?>
