<?php
    include "koneksi.php";
    $id = $_GET['id'];
    $query = mysqli_query($conn,"DELETE FROM produk WHERE id_barang = '$id'");
    if ($query){
        header("location: ../database.php");
    } else {
        echo "<script>alert('Gagal Hapus Data');window.location.href='../database.php'";
    }
?>