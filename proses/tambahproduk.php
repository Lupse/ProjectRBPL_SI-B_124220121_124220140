<?php
    include "koneksi.php";
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];

    $query = mysqli_query($conn,"INSERT INTO produk VALUES ('','$nama','$harga')");
    if($query){
        header("Location: ../database.php");
    } else {
        echo "<script>alert('Gagal Input Data');window.location.href='../database.php'";
    }
?>