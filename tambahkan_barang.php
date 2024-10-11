<?php

include 'config.php';

// jika form di submit maka tambahkan data ke table barang
// cek jika form di submit (dengan method POST) maka tambahkan data ke table barang
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // syntax ini digunakan untuk menambahkan data ke table barang
    // data yang diinputkan user dari form akan di tambahkan ke table barang
    // jika berhasil maka akan muncul pesan "BERHASIL DITAMBAHKAN!"
    // jika gagal maka akan muncul pesan error yang di set di variabel $conn->error
    $sql = "INSERT INTO barang (nama_barang, harga, stok) VALUES ('$nama_barang', '$harga', '$stok')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('BERHASIL DITAMBAHKAN!')</script>";
    } else {
        echo "ERROR :(" . $conn->error;
    }
    
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAMBAHKAN BARANG | &copy; MOCHiQBAAL</title>
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
     <!-- BAGIAN NAVBAR -->
     <nav>
        <a href="">
        <img src="assets/logo.jpg" alt="MochiQBAL" width="55" class=" rounded-circle" style="position: absolute; margin: 1px"> 
    </a>
    <ul class="nav justify-content-center fs-3 bg-primary ">
    
        <li class="nav-item">
            <a class="nav-link active text-light "   href="tampilan_dataBarang.php">Master</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="memilih_barang.php">Transaksi</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-light" href="dashboard.php">Dashboard</a>
  </li>

</ul>
</nav>
<!-- BAGIAN NAVBAR -->

<div class="m-2 mb-5">
  <a href="tambahkan_barang.php" class="btn btn-success mr-2 fw-semibold" aria-current="page">Input Data Barang</a>
  <a href="tampilan_dataBarang.php" class="btn btn-success fw-semibold" aria-current="page">Lihat Data Barang</a>
</div>

<div class="border-4 p-1 mb-4 m-4 text-body border-start bg-warning-subtle border-warning w-75 text-start mx-auto">
        <h4 class="text-start ml-2 ">  INPUT DATA BARANG</h4>
    </div>


    <div class="container w-75">
        <form action="" method="POST">
            
            <div class="row mb-2">
                <label for="nama_barang" class="col-md-3 col-form-label fs-5">Nama Barang</label>
                <div class="col-md-9">
                    <input type="text" id="nama_barang" name="nama_barang" required class="form-control"> <br>
                </div> 
            </div>

            <div class="row mb-2">
                <label for="harga" class="col-md-3 col-form-label fs-5">Harga 1 Unit : </label>
                <div class="col-md-9">
                    <input type="number" class="form-control" id="harga" name="harga" required> <br>
                </div>
            </div>

            <div class="row mb-2">
                <label for="stok" class="col-md-3 col-form-label fs-5">Stok</label>
                <div class="col-md-9">
                    <input type="number" class="form-control" id="stok" name="stok" required> 
                </div>
            </div>

            <div class="d-grid d-md-flex justify-content-md-center">
                <button type="submit" class="btn btn-success ml-5 fw-semibold mt-4 w-10 fs-6 start-100"> [+] TAMBAHKAN [+] </button>
                </div>
    
        </form>
</div>

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>