<?php
include '../koneksi.php';

$errors = [];

// Ambil data dari form
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$price = isset($_POST['price']) ? trim($_POST['price']) : '';
$description = isset($_POST['description']) ? trim($_POST['description']) : '';
$stock = isset($_POST['Stock']) ? trim($_POST['Stock']) : '';
$category = isset($_POST['category']) ? trim($_POST['category']) : '';

// Validasi data
if ($name === '') $errors[] = 'Nama produk wajib diisi.';
if ($price === '' || !is_numeric($price) || $price < 0) $errors[] = 'Harga wajib diisi dan harus berupa angka positif.';
if ($description === '') $errors[] = 'Deskripsi wajib diisi.';
if ($stock === '' || !is_numeric($stock) || $stock < 0) $errors[] = 'Stok wajib diisi dan harus berupa angka positif.';
if ($category === '') $errors[] = 'Kategori wajib dipilih.';
if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    $errors[] = 'Gambar wajib diunggah.';
}

// Jika ada error, redirect kembali ke form dengan pesan error
if (!empty($errors)) {
    header('Location: product.php?error=' . urlencode(json_encode($errors)));
    exit;
}

// Proses upload gambar
$uploadDir = '../images/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}
$imageName = time() . '_' . basename($_FILES['image']['name']);
$imagePath = $uploadDir . $imageName;
if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
    $errors[] = 'Gagal mengupload gambar.';
    header('Location: product.php?error=' . urlencode(json_encode($errors)));
    exit;
}

// Simpan ke database
$stmt = mysqli_prepare($conn, "INSERT INTO products (NamaProduk, Harga, image, Deskripsi, Stock, Kategori) VALUES (?, ?, ?, ?, ?, ?)");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'sissis', $name, $price, $imageName, $description, $stock, $category);
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    if ($success) {
        header('Location: ../product.php?success=1');
        exit;
    } else {
        $errors[] = 'Gagal menyimpan data ke database.';
    }
} else {
    $errors[] = 'Gagal menyiapkan query database.';
}

// Jika gagal, hapus gambar yang sudah diupload
if (file_exists($imagePath)) {
    unlink($imagePath);
}
header('Location: product.php?error=' . urlencode(json_encode($errors)));
exit;
?>
