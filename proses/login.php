<?php
    include "koneksi.php";
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM akun WHERE username ='$username'");
    $data = mysqli_fetch_assoc($query);
    if (mysqli_num_rows($query)>0){
        if($data['username']=='manajer' && $data['password']=='manajer'){
            session_start();
            $_SESSION['username']=$username;
            header("location:../laporan.php");
        }
        else if($data['password']==$password){
            session_start();
            $_SESSION['username']=$username;
            header("location:../dashboard.html");
        }else{
            echo "<script>alert('username atau password salah!'); window.location.href = '../login.html';<script>";
        }
    }else{
        echo "<script>alert('username tidak ditemukan!'); window.location.href = '../login.html';<script>";
    }
?>