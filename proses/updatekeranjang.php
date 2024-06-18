<?php
session_start();

$product_id = $_POST['product_id'];
$new_quantity = $_POST['quantity'];

// Memeriksa apakah produk ada di keranjang
if (isset($_SESSION['cart'][$product_id])) {
    // Mengupdate jumlah produk
    if ($new_quantity > 0) {
        $_SESSION['cart'][$product_id]['quantity'] = $new_quantity;
    } else {
        // Jika jumlah baru kurang dari atau sama dengan 0, hapus produk dari keranjang
        unset($_SESSION['cart'][$product_id]);
    }
}

// Redirect ke halaman keranjang belanja
header("Location: ../kasir.php");
exit();
?>
