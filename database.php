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
        <div class="row" style="height:86.5vh;" >
            <!-- LEFT COL -->
            <div class="col-2 p-2 m-0 d-flex flex-column"  style=" gap: 1em; height:100%;background-color: #eeeeee; position:relative">
                <h5 class="mt-2"><center>NAVIGATION</center></h5>
                <a href="" class="btn btn-outline-success" style="height: 3em; width:100%; display:flex; justify-content:center; align-items:center">
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
            <div class="col-10 p-5">
                <div style="display: flex; justify-content:space-between">
                    <h3 class="mb-3">Database Product</h3>
                    <a href="tambah_produk.php" class="btn btn-outline-success" style="display: flex; align-items:center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    </a>
                </div>
                <!-- TABLE -->
            <table class="table table-striped mt-3" style="width: 100%;">
                                <thead>
                                    <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">ID Barang</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                                <tbody>
                                    <?php
                                        include "proses/koneksi.php";
                                        $query = "SELECT * FROM produk";
                                        $no = 1;
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                    <tr>
                                        <th scope="row"><?=$no;?></th>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['harga'] ?></td>
                                        <td><?= $row['id_barang'] ?></td>
                                        <td style="display: flex; gap:1em; align-items:center; height:100%">
                                            <form action="edit_produk.php?id=<?=$row['id_barang']?>" method="GET">
                                                <input type="hidden" value="<?=$row['id_barang']?>" name="id">
                                                <button type="submit" class="btn btn-sm btn-primary" style="width: 5em;" >Edit</a>
                                            </form>
                                            <form action="proses/hapusproduk.php" method="GET" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                                <input type="hidden" value="<?=$row['id_barang']?>" name="id">
                                                <button type="submit" class="btn btn-sm btn-danger" style="width: 5em;">Hapus</button>
                                            </form>

                                        </td>
                                    </tr>
                                    <?php $no++;} ?>
                                </tbody>
                                </table>
                                <!-- TABLE END -->
            </div>
        </div>
    </div>
    <!-- CONTENT END -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>