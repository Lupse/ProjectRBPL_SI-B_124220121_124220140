<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.html");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/database.css">
    <title>Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="display: flex;align-items:center;">
            <img src="asset/logo.jpg" class="d-inline-block align-text-top" style="width: 4em;mix-blend-mode:multiply;">
            DenAyu
            </a>
        </div>
    </nav>
    <!-- NAVBAR END -->

    <!-- CONTENT -->    
    <div class="container-fluid">
        <div class="row" style="height:84.5vh;">
            <!-- LEFT COL -->
            <div class="col-2 p-2 m-0 d-flex flex-column"  style="gap: 1em; height:100%;background-color: #eeeeee; position:relative">
                <h5 class="mt-2"><center>NAVIGATION</center></h5>
                <a href="database.php" class="btn btn-outline-success" style="height: 3em; width:100%; display:flex; justify-content:center; align-items:center">
                    Database Product
                </a>
                <a href="laporan.php" class="btn btn-outline-success" style="height: 3em; width:100%; display:flex; justify-content:center; align-items:center">
                    Laporan Pembelian
                </a>
                <a href="logout.php" class="btn btn-outline-danger" style="height: 3em; width:100%; display:flex; justify-content:center; align-items:center;">
                    Logout
                </a>
            </div>
            <!-- LEFT COL END -->
            
            <!-- RIGHT COL -->
            <div class="col-10 p-5">
                <h3 class="mb-5">Tambah Data Produk</h3>

                <form action="proses/tambahproduk.php" method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                    <input type="text"  name="nama" class="form-control" id="exampleInputEmail1" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Harga</label>
                    <input type="text"  name="harga" class="form-control" id="exampleInputEmail1" >
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                
            </div>
            <!-- RIGHT COL END -->
        </div>
    </div>
    <!-- CONTENT END -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>