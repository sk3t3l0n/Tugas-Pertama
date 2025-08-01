<?php
include '../koneksi.php';

$query = "SELECT * FROM products ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tabel Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Tabel Produk</h2>
    <a href="product.php" class="btn btn-success mb-3">Tambah Produk</a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Deskripsi</th>
                <th>Stok</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['NamaProduk']) ?></td>
                <td>Rp<?= number_format($row['Harga'], 0, ',', '.') ?></td>
                <td>
                    <?php if (!empty($row['image'])): ?>
                        <img src="../images/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['NamaProduk']) ?>" style="width:80px; height:80px; object-fit:cover;">
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($row['Deskripsi']) ?></td>
                <td><?= htmlspecialchars($row['Stock']) ?></td>
                <td><?= htmlspecialchars($row['Kategori']) ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
