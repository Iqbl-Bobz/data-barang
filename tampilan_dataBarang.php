<?php

include 'config.php';

$query = "SELECT * FROM barang";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA BARANG | &copy; MOCHiQBAAL</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="style/style.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wdth,wght@0,75..100,300..800;1,75..100,300..800&display=swap" rel="stylesheet">
</head>
<body style="background-color: rgb(236, 232, 222);">


<header class="header justify-content-start bg-primary navbar-expand-xl navbar">
    <h5 class="text-light text-sm-center nav-item mx-auto">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Necessitatibus, quia.</h5>
</header>

    <!-- BAGIAN NAVBAR -->
    <nav class="nav navbar-expand-xl fs-4 w-25 bg-secondary flex-column d-flex justify-content-start align-items-center custom-navbar">    
    <figure class="text-center mb-0 ">
        <a href="index.php">
            <img src="assets/logo.jpg" alt="MochIqbal" class="rounded-circle w-50 mt-2 m-1" title="MOCHiQBAAL">
        </a>
            <figcaption class="fs-4 fw-semibold text-light ">MochIqbaal</figcaption>
            <figcaption class="fs-5 fw-semibold text-light ">( 121404 )</figcaption>
        </figure>

        <ul class="nav justify-content-start flex-column mt-2 " >
            <li class="nav-item text-center z-2">
                <a class="nav-link active text-dark fw-semibold " aria-current="page" 
                href="tampilan_dataBarang.php"><i class="fa-solid fa-desktop fs-5" title="Master"></i> Master</a>
            </li>
            <li class="nav-item text-center z-3">
                <a class="nav-link text-dark fw-semibold" href="tambahkan_transaksi.php"><i class="fa-solid fa-cart-shopping fs-4" title="Transaksi"></i> Transaksi</a>
            </li>
            <li class="nav-item text-center z-3">
                <a class="nav-link text-dark  fw-semibold " href="Dashboard.php"> <i class="fa-solid fa-clipboard fs-4" title="Dashboard"></i> Dashboard</a>
            </li>
        </ul>

</nav>
<!-- BAGIAN NAVBAR -->


<!-- BAGIAN TABEL DAN ISI -->
<div class="container position-relative " style="margin-top: -450px;">
    <div class="m-2 mb-5 text-center position-relative" >
      <a href="tambahkan_barang.php" class="btn btn-success mr-2 fw-semibold" aria-current="page">Input Data Barang</a>
      <a href="tampilan_dataBarang.php" class="btn btn-success fw-semibold" aria-current="page">Lihat Data Barang</a>
    </div>
    
        <div class="border-4 float-end p-1 mb-4  text-body border-start  bg-warning-subtle border-warning w-75   ">
            <h4 class="text-start  ">  DATA BARANG</h4>
        </div>
    
            <table class="table table-secondary table-striped w-75 float-end col-xl-12  " border="1" cellpadding="10" cellspacing="0" style="text-align: center;">
                <tr class="table-dark">
                <th >No.</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Harga Per Unit  </th>
                <th>Stok</th>
                <th>Opsi</th>
            </tr>
            
            <tr>
                <?php $i=1; 
                while ($row =mysqli_fetch_assoc($result)) : ?>
                <td > <?= $i++; ?></td>
                <td> <strong style="color: orange;"><?= $row["id_barang"]; ?></strong> </td>
                <td> <?= $row["nama_barang"];?></td>
                <td> Rp. <?= $row["harga"]; ?></td>
                <td><?= $row["stok"];?></td>
                <td>
                    <button type="button" class="btn btn-primary ">
                        <a class="text-light fw-semibold text-decoration-none" href="edit_barang.php?id_barang=<?= $row["id_barang"]; ?>">Edit</a> 
                    </button> 
                    |
                    <button type="button" class="btn btn-danger ">
                        <a class="text-light fw-semibold text-decoration-none" href="hapus_barang.php?id_barang=<?= $row["id_barang"]; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');">Hapus</a>
                    </button>
                </td>
            </tr>
    
            <?php endwhile ?>
        </table>
</div>
<!-- BAGIAN TABEL DAN ISI -->

 
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>