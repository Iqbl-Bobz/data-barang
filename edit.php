<?php
include 'config.php';
$id_barang = $_GET['id_barang'];
$query = "SELECT * FROM barang WHERE id_barang = $id_barang";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $query = "UPDATE barang SET nama_barang = '$nama_barang', harga = '$harga', stok = '$stok' WHERE id_barang = $id_barang";
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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body style="background-color: #1A2335;">
    <a href="index.php">
        <input type="button" value="&laquo KEMBALI &laquo" class="btn btn-light m-3 fs-5">
    </a>
    <h1 class="title text-center bg-primary p-2 w-100 text-light">Edit Barang by<span> MochiQBAL</span></h1>
    <form action="" method="POST">
    <div class="form w-50 mt-4 m-auto d-flex flex-column"> 

        <div class="form-floating mb-3">
            <input type="text" name="nama_barang" id="nama_barang floatingInput" class="form-control" placeholder="nama" value="<?= $data['nama_barang']; ?>" required>
            <label for="nama_barang floatingInput">Nama Barang:</label>
        </div>

        <div class="form-floating mb-3">
            <input type="number" name="harga" id="harga floatingInput" class="form-control" placeholder="harga" value="<?= $data['harga']; ?>" required>
            <label for="harga floatingInput">Harga:</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" name="stok" id="stok floatingInput" class="form-control" placeholder="stok" value="<?= $data['stok']; ?>"> <br>
            <label for="stok">Stok</label>
        </div>

            <button type="submit" name="submit" class="btn btn-success w-25  m-auto fs-4">SIMPAN</button>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
