<?php
    include "koneksi.php";
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];

    $query = mysqli_query($conn,"UPDATE produk SET nama = '$nama', harga = '$harga' WHERE id_barang = '$id'");
    if($query){
        header("Location: ../database.php");
    } else {
        echo "<script>alert('Gagal Edit Data');window.location.href='../database.php'";
    }
?>