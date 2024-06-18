<?php
session_start();

// Contoh data produk yang akan ditambahkan ke keranjang (biasanya ini diambil dari database)
$product_id = $_POST['id_barang']; // ID produk dari form
$product_name = $_POST['nama'];
$product_price = $_POST['harga'];

// Memeriksa apakah keranjang belanja sudah ada di session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Memeriksa apakah produk sudah ada di keranjang
if (isset($_SESSION['cart'][$product_id])) {
    // Jika produk sudah ada, tambahkan jumlahnya
    $_SESSION['cart'][$product_id]['quantity'] += 1;
} else {
    // Jika produk belum ada, tambahkan produk ke keranjang
    $_SESSION['cart'][$product_id] = [
        'id_produk' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
        'quantity' => 1
    ];
}

// Redirect ke halaman keranjang belanja
header("Location: ../kasir.php");
exit();
?>

