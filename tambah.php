<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $query = "INSERT INTO barang (nama_barang, harga, stok) VALUES ('$nama_barang', '$harga','$stok')";
    mysqli_query($conn, $query);


        header("Location: index.php");
        
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body style="background-color: #1A2335;">
    <a href="index.php">
        <input type="button" value="&laquo KEMBALI &laquo" class="btn btn-light m-3 fs-5">
    </a>
    <h1 class="title text-center bg-primary p-2 w-100 text-light">Tambah Barang by<span> MochiQBAL</span></h1>
    <form action="" method="POST" >
        <div class="form w-50 mt-4 m-auto d-flex flex-column">
            <div class="form-floating mb-3">
                <input type="text" name="nama_barang" id="nama_barang floatingInput" class="form-control text-dark" placeholder="nama barang" required>
                <label for="nama_barang floatingInput" >Tambah Barang:</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" name="harga" id="harga floatingInput" class="form-control" placeholder="Harga" required>
                <label for="harga floatingInput">Harga:</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="stok" id="stok floatingInput" class="form-control" placeholder="Stok" required>
                <label for="stok floatingInput"> Stok : </label>
            </div>
            <br>
            <button type="submit" name="submit" class="btn btn-success w-25  m-auto fs-4">TAMBAH  </button>
        </div>
    </form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
