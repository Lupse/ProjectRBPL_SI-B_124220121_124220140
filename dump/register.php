<?php
    include "koneksi.php";
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $query = mysqli_query($conn, "INSERT INTO akun VALUES ('','$username','$password','$email')");
    if ($query) {
        echo "<script>alert('Berhasil Membuat Akun');window.location.href='../login.html'</script>";
    }else{
        echo "<script>alert('Gagal Membuat Akun');window.location.href='../register.html'</script>";
    }
?>