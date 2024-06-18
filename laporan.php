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
        <div class="row" style="height: 85vh">
            <!-- LEFT COL -->
            <div class="col-2 p-2 m-0 d-flex flex-column"  style=" gap: 1em; height:100%vh;background-color: #eeeeee; position:relative">
                <h5 class="mt-2"><center>NAVIGATION</center></h5>
                <a href="database.php" class="btn btn-outline-success" style="height: 3em; width:100%; display:flex; justify-content:center; align-items:center">
                    Database Product
                </a>
                <a href="laporan.php" class="btn btn-outline-success" style="height: 3em; width:100%; display:flex; justify-content:center; align-items:center">
                    Laporan Penjualan
                </a>
                <a href="logout.php" class="btn btn-outline-danger" style="height: 3em; width:100%; display:flex; justify-content:center; align-items:center;">
                    Logout
                </a>
            </div>
            <!-- LEFT COL END -->
            <div class="col-10 p-5">
                <div style="display: flex; justify-content:space-between">
                    <h3 class="mb-3">Laporan Penjualan</h3>
                    <form action="laporan_search.php" method="GET">
                        <input type="date" name="tanggal" id="tanggal">
                        <input type="submit" class="btn btn-success" value="Cari">
                    </form>
                </div>
               <!-- TABLE -->
                <table class="table mt-3" style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">Id Nota</th>
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "proses/koneksi.php";
                        $query = "SELECT nota.id_nota, nota.tanggal_nota, produk.nama, transaksi.jumlah 
                                FROM transaksi 
                                INNER JOIN nota ON transaksi.id_nota = nota.id_nota 
                                INNER JOIN produk ON transaksi.id_barang = produk.id_barang";
                        $result = mysqli_query($conn, $query);

                        // Menyimpan hasil query dalam array
                        $data = [];
                        while ($row = mysqli_fetch_assoc($result)) {
                            $data[] = $row;
                        }

                        // Menghitung jumlah baris yang sama untuk setiap id_nota dan tanggal_nota
                        $counts = [];
                        foreach ($data as $row) {
                            $key = $row['id_nota'] . '-' . $row['tanggal_nota'];
                            if (!isset($counts[$key])) {
                                $counts[$key] = 0;
                            }
                            $counts[$key]++;
                        }

                        // Menampilkan data dengan rowspan
                        $displayed = [];
                        foreach ($data as $row) {
                            $key = $row['id_nota'] . '-' . $row['tanggal_nota'];
                            echo '<tr>';
                            if (!isset($displayed[$key])) {
                                echo '<td rowspan="' . $counts[$key] . '">' . $row['id_nota'] . '</td>';
                                echo '<td rowspan="' . $counts[$key] . '">' . $row['tanggal_nota'] . '</td>';
                                $displayed[$key] = true;
                            }
                            echo '<td>' . $row['nama'] . '</td>';
                            echo '<td>' . $row['jumlah'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <!-- TABLE END -->

            </div>
        </div>
    </div>
    <!-- Mengambil input date dan merubahnya menjadi yyyy-mm-dd -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('dateForm').addEventListener('submit', function(event) {
            let dateInput = document.getElementById('tanggal');
            let dateValue = dateInput.value;
            console.log(dateValue); // Output: yyyy-mm-dd
            // Additional processing if needed
            // Example: Format the date if necessary
            // Note: No need for additional formatting as date input already provides yyyy-mm-dd
        });
    });
    </script>

    <!-- CONTENT END -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>