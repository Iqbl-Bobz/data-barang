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
</head>
<body>
    <h1>Tambah Barang</h1>
    <form action="" method="POST">
        <label for="nama_barang">Nama Barang:</label>
        <input type="text" name="nama_barang" id="nama_barang" required>
        <br>
        <label for="harga">Harga:</label>
        <input type="number" name="harga" id="harga" required>
        <br>
        <label for="stok"> Stok : </label>
        <input type="text" name="stok" id="stok" required>
         <br>
        <button type="submit" name="submit">Tambah</button>
    </form>
</body>
</html>
