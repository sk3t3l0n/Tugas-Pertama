<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Tambah Produk</title>
    <!-- Link Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Form Tambah Produk</h4>
        </div>
        <div class="card-body">

            <?php
            $nama = $harga = $deskripsi = "";
            $errors = [];

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nama = trim($_POST["nama"]);
                $harga = trim($_POST["harga"]);
                $deskripsi = trim($_POST["deskripsi"]);

                // Validasi
                if (empty($nama)) {
                    $errors[] = "Nama produk tidak boleh kosong.";
                }

                if (empty($harga)) {
                    $errors[] = "Harga produk tidak boleh kosong.";
                } elseif (!is_numeric($harga)) {
                    $errors[] = "Harga harus berupa angka.";
                }

                if (empty($deskripsi)) {
                    $errors[] = "Deskripsi produk tidak boleh kosong.";
                }

                if (empty($errors)) {
                    echo '<div class="alert alert-success">';
                    echo '<h5>Produk berhasil ditambahkan:</h5>';
                    echo "<ul>";
                    echo "<li><strong>Nama:</strong> " . htmlspecialchars($nama) . "</li>";
                    echo "<li><strong>Harga:</strong> Rp " . number_format($harga, 0, ',', '.') . "</li>";
                    echo "<li><strong>Deskripsi:</strong> " . htmlspecialchars($deskripsi) . "</li>";
                    echo "</ul>";
                    echo '</div>';

                    // Reset
                    $nama = $harga = $deskripsi = "";
                } else {
                    echo '<div class="alert alert-danger"><ul class="mb-0">';
                    foreach ($errors as $error) {
                        echo "<li>" . htmlspecialchars($error) . "</li>";
                    }
                    echo "</ul></div>";
                }
            }
            ?>

            <!-- Form Input Produk -->
            <form method="post" action="">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Produk</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="<?php echo htmlspecialchars($nama); ?>">
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga Produk</label>
                    <input type="text" name="harga" id="harga" class="form-control" value="<?php echo htmlspecialchars($harga); ?>">
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control"><?php echo htmlspecialchars($deskripsi); ?></textarea>
                </div>

                <button type="submit" class="btn btn-success">Tambah Produk</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS (opsional, untuk komponen interaktif) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
