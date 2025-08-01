<?php
// Inisialisasi variabel error
$errors = [];
if (isset($_GET['error'])) {
    $errors = json_decode($_GET['error'], true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Input Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Input Produk Baru</h2>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="query.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="name" required>
            <div class="invalid-feedback">Nama produk wajib diisi.</div>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" class="form-control" id="price" name="price" min="0" required>
            <div class="invalid-feedback">Harga wajib diisi.</div>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            <div class="invalid-feedback">Gambar wajib diunggah.</div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            <div class="invalid-feedback">Deskripsi wajib diisi.</div>
        </div>
        <div class="mb-3">
            <label for="Stock" class="form-label">Stok</label>
            <input type="number" class="form-control" id="Stock" name="Stock" min="0" required>
            <div class="invalid-feedback">Stok wajib diisi.</div>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <select class="form-select" id="category" name="category" required>
                <option value="">Pilih Kategori</option>
                <option value="Elektronik">Elektronik</option>
                <option value="Fashion">Fashion</option>
                <option value="Makanan">Makanan</option>
            </select>
            <div class="invalid-feedback">Kategori wajib dipilih.</div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Produk</button>
    </form>
</div>
<script>
// Bootstrap 5 form validation
(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
})();
</script>
</body>
</html>
