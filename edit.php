<?php
include 'config.php';
$id = $_GET['id'];
$query = "SELECT * FROM barang WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $query = "UPDATE barang SET nama_barang = '$nama_barang', harga = '$harga', stok = '$stok' WHERE id = $id";
    mysqli_query($conn, $query);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
</head>
<body>
    <h1>Edit Barang</h1>
    <form action="" method="POST">
        <label for="nama_barang">Nama Barang:</label>
        <input type="text" name="nama_barang" id="nama_barang" value="<?= $data['nama_barang']; ?>" required>
        <br>
        <label for="harga">Harga:</label>
        <input type="number" name="harga" id="harga" value="<?= $data['harga']; ?>" required>
        <br>
        <label for="stok">Stok</label>
        <input type="text" name="stok" id="stok" value="<?= $data['stok']; ?>">
        <button type="submit" name="submit">Edit</button>
    </form>
</body>
</html>
