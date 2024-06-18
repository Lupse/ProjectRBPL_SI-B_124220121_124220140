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
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="display: flex;align-items:center">
            <img src="asset/logo.jpg" class="d-inline-block align-text-top" style="width: 4em; mix-blend-mode:multiply;">
            DenAyu
            </a>
        </div>
    </nav>
    <!-- NAVBAR END -->

    <!-- CONTENT -->
    <div style="display: flex;">
            <div class="col-2 p-2 m-0 d-flex flex-column"  style=" gap: 1em; height:100%vh;background-color: #eeeeee; position:relative">
                <h5 class="mt-2"><center>NAVIGATION</center></h5>
                <a href="kasir.php" class="btn btn-outline-success" style="height: 3em; width:100%; display:flex; justify-content:center; align-items:center">
                    Kasir
                </a>
                <a href="dashboard.html" class="btn btn-outline-secondary" style="height: 3em; width:100%; display:flex; justify-content:center; align-items:center">
                    Kembali
                </a>
                <a href="logout.php" class="btn btn-outline-danger" style="height: 3em; width:100%; display:flex; justify-content:center; align-items:center;">
                    Logout
                </a>
            </div>

        <div class="container-fluid">
            <div style="display: flex; align-items:center;">
                <div class="row border border-1" style="width: 105%;">
                <!-- DAFTAR BARANG START -->
                <div class="col-8 border border-1" style="height: 65vh;">
                    <div style="  overflow: auto; width: 100%;height: 64.6vh;">
                        <h3 class="mt-3 mb-3"><center>Daftar Barang</center></h3>
                        <!-- SEARCH FORM -->
                        <form class="d-flex" role="search" action="kasir_search.php" method="GET" >
                            <input class="form-control me-2" type="search" placeholder="Cari Barang Berdasarkan ID Barang" aria-label="Search" name="id">
                            <button class="btn btn-outline-success" type="submit">Cari</button>
                        </form>
                        <!-- SEARCH FORM END -->
                        
                            <!-- TABLE -->
                            <table class="table table-striped mt-3" style="width: 100%;">
                                <thead>
                                    <tr>
                                    <th scope="col">Tambah</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">ID Barang</th>
                                </tr>
                            </thead>
                                <tbody>
                                    <?php
                                        include "proses/koneksi.php";
                                        $query = "SELECT * FROM produk";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                    <tr>
                                        <th scope="row">
                                            <form action="proses/tambahkeranjang.php" method="POST">
                                                <input type="hidden" value="<?= $row['id_barang']; ?>" name="id_barang">
                                                <input type="hidden" value="<?= $row['nama']; ?>" name="nama">
                                                <input type="hidden" value="<?= $row['harga']; ?>" name="harga">
                                                <button type="submit" class="btn btn-outline-success">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                                </button>
                                            </form>
                                    </th>
                                    <td><?= $row['nama'] ?></td>
                                        <td><?= $row['harga'] ?></td>
                                        <td><?= $row['id_barang'] ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                </table>
                                <!-- TABLE END -->
                    </div>
                </div>
                <!-- DAFTAR BARANG END -->
                
                <!-- DAFTAR BARANG -->
                <div class="col-4 border border-1" style="height: 65vh;">
                    <div style="overflow: auto; width: 100%;height: 55vh;">
                        <h3 class="mt-3"><center>Keranjang  Belanja</center></h3>
                        <!-- TABLE -->
                        <table class="table table-striped mt-3" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col">Hapus</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $total = 0;
                                    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                                        foreach ($_SESSION['cart'] as $product_id => $product) {
                                            $subtotal = $product['price'] * $product['quantity'];
                                            $total += $subtotal;
                                            echo "<tr>
                                            <td>
                                            <form action='proses/updatekeranjang.php' method='post'>
                                            <input type='hidden' name='product_id' value='{$product_id}'>
                                            <input type='hidden' name='quantity' value='0'>
                                            <button type='submit' class='btn btn-outline-danger'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-minus'><line x1='5' y1='12' x2='19' y2='12'></line></svg>
                                            </button>
                                                </form>
                                                </td>
                                                <td>{$product['name']}</td>
                                                <td>{$product['price']}</td>
                                                <td>{$product['quantity']}</td>
                                                <td>{$subtotal}</td>
                                                </tr>";
                                            }
                                    } else {
                                        echo "<tr><td colspan='5'><center>Keranjang belanja kosong.</center></td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                                <!-- TABLE END -->
                    </div>
                    <a href="proses/reset.php" class="btn btn-outline-danger" style="width: 100%; margin-top:1em;">Reset</a>
                </div>
                <!-- DAFTAR BARANG END -->

            </div>
    </div>
    <!-- TOTAL HARGA -->
    <div class="container-fluid" style="display: flex; align-items: center;justify-content:space-between; height:19.3vh;width:100%">
        <div class="kiri">
            <h1>Total Harga</h1>
        </div>
        <div class="kanan" style="display: flex; align-items:center; gap:2em;">
            <h1>Rp.<?= $total ?></h1>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Bayar
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="margin-top: 10em;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- Modal Body -->
                        <div class="modal-body">
                            <!-- Total Harga -->
                            <div class="row">
                                <div class="col-3">
                                    Total Harga 
                                </div>
                                <div class="col-9">
                                    : Rp.<?= $total ?>
                                </div>
                            </div>
                            <!-- Total Harga End -->
                            <hr>
                            <!-- Total Bayar -->
                            <form action="nota.php" method="POST">
                                <div class="row">
                                <div class="col-3">
                                    Bayar
                                </div>
                                <div class="col-9">
                                    : Rp. <input type="text" name="bayar" id="modalInput">
                                </div>
                            </div>
                            <!-- Total Harga End -->
                        </div>
                        <!-- Modal End -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <?php
                                $_SESSION['total'] = $total;
                                ?>
                            <input type="hidden" name="total" value="<?= $_SESSION['total'] ?>">
                            <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Bayar
                            </button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
                <!-- Modal End -->
        </div>
    </div>
    <!-- TOTAL HARGA END -->
</div>
    <!-- CONTENT END -->
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    // Fokus pada input di modal kedua saat modal kedua ditampilkan
    var exampleModal = document.getElementById('exampleModal');
    exampleModal.addEventListener('shown.bs.modal', function () {
        document.getElementById('modalInput').focus();
    });
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>