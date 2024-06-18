<?php
    session_start();
    
    if(!isset($_POST['bayar']) || !is_numeric($_POST['bayar'])){
        header("Location: kasir.php");
        exit();
    }

    $kembalian = $_POST['bayar'] - $_SESSION['total'];

    if($kembalian<0){
        echo "<script>alert('Uang tidak cukup');window.location.href='kasir.php';</script>";
    }

    if(!isset($_SESSION['username'])){
        header("Location: login.html");
        exit();
    }
    

    foreach ($_SESSION['cart'] as $product_id => $product) {
        $subtotal = $product['price'] * $product['quantity'];
    }

    if($product<=0){
        echo "<script>alert('Keranjang Masih Kosong!');window.location.href='kasir.php';</script>";
    }

    $date = date("Y/m/d");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/nota.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div style="position: absolute; left:5em;top:5em;">
    <a href="kasir.php" style="all: unset;">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    </a>
    </div>
    <!-- NOTA -->
    <div class="nota">
    <div id="content" style="padding: 2em;">
        <center>
            <h3>Nota Pembelian</h3>
            <hr>
        </center>

        <h6>
            <div class="row">
                <div class="col-6">
                    Nama Barang
                </div>
                <div class="col-3">
                    Harga
                </div>
                <div class="col-3">
                    Jumlah
                </div>
            </div>
            <hr>
            <!-- BARANG -->
            <?php
            foreach ($_SESSION['cart'] as $product_id => $product) {
            ?>
            <div class="row">
                <div class="col-6">
                    <?= $product['name']; ?>
                </div>
                <div class="col-3">
                    <?= $product['price']; ?>
                </div>
                <div class="col-3">
                    <p class="ms-4"><?= $product['quantity']; ?></p>
                </div>
            </div>
            <?php } ?>
            <hr>
        </h6>
        <!-- BARANG END -->

        <!-- PEMBAYARAN -->
        <div style="display: flex; align-items:center; justify-content:space-between">
            <h3>Total</h3>
            <h3>Rp. <?= $_SESSION['total'] ?></h3>
        </div>
        <div style="display: flex; align-items:center; justify-content:space-between">
            <h5>Bayar</h5>
            <h5>Rp. <?= $_POST['bayar'] ?></h5>
        </div>
        <hr>
        <!-- PEMBAYARAN END -->

        <!-- KEMBALIAN -->
        <div style="display: flex; align-items:center; justify-content:space-between">
            <h6>Kembalian</h6>
            <h6>Rp. <?= $kembalian ?></h6>
        </div>
        <!-- KEMBALIAN END-->
    </div>
        <form action="proses/catat.php" method="POST">
            <input type="hidden" name="tanggal" value="<?= $date; ?>">
            <button type="submit" class="btn btn-outline-success" style="width: 100%; margin-top:3em;">Cetak Nota</button>
        </form>
    </div>
    <!-- NOTA END -->

    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>