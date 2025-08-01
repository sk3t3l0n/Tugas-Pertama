
<?php
include 'koneksi.php';

$kategoriList = ['Elektronik', 'Fashion', 'Makanan'];
$selectedKategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

if ($selectedKategori && in_array($selectedKategori, $kategoriList)) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE kategori = ?");
    mysqli_stmt_bind_param($stmt, 's', $selectedKategori);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    $query = "SELECT * FROM products";
    $result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Daftar Produk</h2>
    <form method="get" class="mb-4 row g-3 align-items-center">
        <div class="col-auto">
            <label for="kategori" class="col-form-label">Filter Kategori:</label>
        </div>
        <div class="col-auto">
            <select name="kategori" id="kategori" class="form-select">
                <option value="">Semua Kategori</option>
                <?php foreach ($kategoriList as $kat): ?>
                    <option value="<?= $kat ?>" <?= $selectedKategori === $kat ? 'selected' : '' ?>><?= $kat ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Tampilkan</button>
        </div>
    </form>
    <div class="row">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="images/<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['NamaProduk']); ?>" style="height: 300px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['NamaProduk']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($row['Deskripsi']); ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Harga: Rp<?php echo number_format($row['Harga'], 0, ',', '.'); ?></li>
                        <li class="list-group-item">Stok: <?php echo htmlspecialchars($row['Stock']); ?></li>
                    </ul>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">Tidak ada produk untuk kategori ini.</div>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>