<?php
    include "koneksi.php";
    session_start(); 

    // Dapatkan tanggal dari POST
    $tanggal = $_POST['tanggal'];

    // Sisipkan data ke dalam tabel nota
    $notaQuery = "INSERT INTO nota (tanggal_nota) VALUES ('$tanggal')";
    $insertNota = mysqli_query($conn, $notaQuery);

    // Periksa apakah penyisipan ke tabel nota berhasil
    if ($insertNota) {
        // Dapatkan id_nota yang baru saja dimasukkan
        $nota_id = mysqli_insert_id($conn);

        // Sisipkan data ke dalam tabel transaksi untuk setiap produk di keranjang
        foreach ($_SESSION['cart'] as $product_id => $product) {
            $product_id = $product['id_produk'];
            $quantity = $product['quantity'];
            $transaksiQuery = "INSERT INTO transaksi (id_nota, id_barang, jumlah) VALUES ('$nota_id', '$product_id', '$quantity')";
            $insertTransaksi = mysqli_query($conn, $transaksiQuery);

            // Periksa apakah penyisipan ke tabel transaksi berhasil
            if (!$insertTransaksi) {
                // Jika ada error, tampilkan pesan error dan hentikan eksekusi
                echo "Error inserting into transaksi: " . mysqli_error($conn);
                exit;
            }
        }
        
        // Jika semua penyisipan berhasil, arahkan kembali ke halaman kasir
        header("location:reset.php");
    } else {
        // Jika penyisipan ke tabel nota gagal, tampilkan pesan error
        echo "Error inserting into nota: " . mysqli_error($conn);
    }
?>
