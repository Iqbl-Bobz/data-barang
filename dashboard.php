<?php
include 'config.php';

// Mengambil data dari tabel barang
$sql_barang = "SELECT COUNT(*) AS total_barang, 
                      SUM(CASE WHEN stok < 5 THEN 1 ELSE 0 END) AS stok_rendah 
               FROM barang";
$result_barang = $conn->query($sql_barang);
$data_barang = $result_barang->fetch_assoc();

// Mengambil data dari tabel detail_penjualan
$sql_transaksi = "SELECT COUNT(*) AS total_transaksi, 
                          SUM(sub_tot) AS total_pendapatan 
                  FROM detail_penjualan";
$result_transaksi = $conn->query($sql_transaksi);
$data_transaksi = $result_transaksi->fetch_assoc();

// Mengambil data aktivitas terbaru
$sql_aktivitas = "SELECT b.nama_barang, dp.jml_barang 
                  FROM detail_penjualan dp 
                  JOIN barang b ON dp.id_barang = b.id_barang 
                  ORDER BY dp.id_penju DESC LIMIT 5";
$result_aktivitas = $conn->query($sql_aktivitas);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
<body>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="style/style.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wdth,wght@0,75..100,300..800;1,75..100,300..800&display=swap" rel="stylesheet">
</head>
<body style="background-color: rgb(236, 232, 222);">


<header class="header justify-content-start bg-primary navbar-expand-xl navbar">
    <h5 class="text-light text-sm-center nav-item mx-auto">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Necessitatibus, quia.</h5>
</header>
    <!-- BAGIAN NAVBAR -->
    <nav class="nav navbar-expand-xl fs-4 w-25 bg-secondary flex-column d-flex justify-content-start align-items-center custom-navbar">    
    <figure class="text-center mb-0 ">
            <img src="assets/logo.jpg" alt="MochIqbal" class="rounded-circle w-50 mt-2 m-1" title="MOCHiQBAAL">
            <figcaption class="fs-4 fw-semibold text-light ">MochIqbaal</figcaption>
            <figcaption class="fs-5 fw-semibold text-light ">( 121404 )</figcaption>
        </figure>

        <ul class="nav justify-content-start flex-column mt-2 " >
            <li class="nav-item text-center z-2">
                <a class="nav-link active text-dark fw-semibold " aria-current="page" href="tampilan_dataBarang.php"><i class="fa-solid fa-desktop fs-4" title="Master"></i> Master</a>
            </li>
            <li class="nav-item text-center z-3">
                <a class="nav-link text-dark fw-semibold" href="tambahkan_transaksi.php"><i class="fa-solid fa-cart-shopping fs-4" title="Transaksi"></i> Transaksi</a>
            </li>
            <li class="nav-item text-center z-3">
                <a class="nav-link text-dark  fw-semibold " href="Dashboard.php"><i class="fa-solid fa-clipboard fs-4" title="Dashboard"></i> Dashboard</a>
            </li>
        </ul>

</nav>
<!-- BAGIAN NAVBAR -->



    <div class=" position-absolute top-0 start-50 translate-middle-x">
        <h1 class="mt-5">Dashboard</h1>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Barang</h5>
                        <p class="card-text"><?= $data_barang['total_barang'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Stok Rendah</h5>
                        <p class="card-text"><?= $data_barang['stok_rendah'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Transaksi</h5>
                        <p class="card-text"><?= $data_transaksi['total_transaksi'] ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">

                    <h3>Total Pendapatan</h3>
                    <p>Rp. <?= number_format($data_transaksi['total_pendapatan'], 0, ',', '.') ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <h3>Aktivitas Terbaru</h3>
                <ul class="list-group">
                    <?php while ($row = $result_aktivitas->fetch_assoc()): ?>
                        <li class="list-group-item">
                            <?= $row['nama_barang'] ?> (<?= $row['jml_barang'] ?> pcs)
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
</div>
 
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 
</body>
</html>
