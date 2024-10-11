<?php 

include 'config.php';

// Koneksi ke database dengan menggunakan file config.php
$id_barang = $_GET['id_barang'];

// ambil data barang berdasar id_barang yang dikirimkan lewat url
$query = "SELECT * FROM barang WHERE id_barang = $id_barang";
// Eksekusi query untuk mengambil data barang berdasar id_barang yang dikirimkan lewat url
$result = mysqli_query($conn, $query);
// ambil data barang yang di pilih berdasar id_barang yang dikirimkan lewat url dan simpan ke dalam variabel $data
$data = mysqli_fetch_assoc($result);

// jika form di submit maka update data ke table barang
if(isset($_POST['submit'])){
    // ambil data yang diinputkan user dari form edit barang
    // untuk diupdate ke table barang
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // update data barang berdasar id_barang yang dikirimkan lewat url
    // dengan data yang diinputkan user dari form edit barang
    $query = "UPDATE barang SET nama_barang = '$nama_barang', harga = '$harga', stok = '$stok' WHERE id_barang = $id_barang";
    mysqli_query($conn, $query); // jalankan query update data ke table barang

    header("Location: tampilan_dataBarang.php");

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT BARANG | &copy; MOCHiQBAAL</title>
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
            <img src="assets/logo.jpg" alt="MochIqbal" class="rounded-circle w-50 mt-2 m-1" title="MOCHiQBAAL">
            <figcaption class="fs-4 fw-semibold text-light ">MochIqbaal</figcaption>
            <figcaption class="fs-5 fw-semibold text-light ">( 121404 )</figcaption>
        </figure>

        <ul class="nav justify-content-start flex-column mt-2 " >
            <li class="nav-item text-center z-2">
                <a class="nav-link active text-dark fw-semibold " aria-current="page" href="tampilan_dataBarang.php">Master</a>
            </li>
            <li class="nav-item text-center z-3">
                <a class="nav-link text-dark fw-semibold" href="tambahkan_transaksi.php">Transaksi</a>
            </li>
            <li class="nav-item text-center z-3">
                <a class="nav-link text-dark  fw-semibold " href="Dashboard.php">Dashboard</a>
            </li>
        </ul>

</nav>
<!-- BAGIAN NAVBAR -->
<!-- BAGIAN ISI -->
<div class="container position-absolute top-50 h-75 start-50 translate-middle flex-column ">
    <div class="border-4 float-end p-1 top-50 mb-4  d-flex text-body border-start  bg-warning-subtle border-warning w-75">
                <h4 class="text-start flex-column ">  EDIT DATA BARANG</h4>
            </div>
    
        <form action="" method="POST">
            <div class="wrapper text-center mt-5"> <br>
            <!-- //input nama barang yang akan diupdate -->
             <div class="mb-3 fs-4 position-relative d-flex">
                <label for="nama_barang" class="form-label flex-column mr-4 position-absolute end-50">Nama Barang : </label>
                <input type="text" class="form-control float-right position-absolute start-50  w-50 " id="nama_barang" name="nama_barang" id="nama_barang" placeholder="nma barang" value="<?= $data['nama_barang']; ?>" required> <br> 
             </div>

                 <!-- //input harga barang yang akan diupdate -->
                <div class="mb-3 fs-4 position-relative d-flex">
                    <label for="harga" class="form-label flex-column mr-4 position-absolute end-50">Harga 1 Unit :</label>
                    <input type="number" name="harga" id="harga" class="form-control float-right position-absolute start-50 w-50" value="<?= $data['harga']; ?>" required> <br>
                </div>
                
                <!-- input stok barang yang akan diupdate -->
                <div class="mb-3 fs-4 position-relative d-flex">
                    <label for="stok" class="form-label flex-column mr-4 position-absolute end-50">Stok : </label>
                    <input type="number" name="stok" id="stok" class="form-control float-right position-absolute start-50 w-50" placeholder="" value="<?= $data['stok']; ?>" required> 
                     <!--  tombol untuk mengupdate data barang yang diilih -->
                    
                     <div class="mb-3 fs-4 position-absolute d-flex end-0">
                         <input type="submit" class="btn btn-success mt-5 " value="[+] UPDATE [+]" name="submit">
                     </div>

                </div>
                 
             </div>
        </form>
    </div>

<!-- BAGIAN ISI -->

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</body>
</html>