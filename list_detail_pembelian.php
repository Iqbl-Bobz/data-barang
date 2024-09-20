<?php
include 'config.php';

// Query untuk TABEL barang
$query_barang = "SELECT * FROM barang";
$result_barang = mysqli_query($conn, $query_barang);

#Query untuk TABEL detail_pembelian
$query_detail = "SELECT detail_pembelian.*, barang.nama_barang FROM detail_pembelian detail_pembelian
                 JOIN barang barang ON detail_pembelian.id_barang = barang.id_barang";
$result_detail = mysqli_query($conn, $query_detail);

// Cek apakah query berhasil
if (!$result_detail) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang dan Detail Pembelian</title>
</head>
<body>
    <a href="list_pembelian.php">
        <input type="button" value="< KEMBALI">
    </a>
    <!-- TABEL BARANG -->
    <h1>Data Barang</h1>
    <a href="tambah.php">Tambah Barang</a>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; while($row = mysqli_fetch_assoc($result_barang)) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row['nama_barang']; ?></td>
                    <td><?= $row['harga']; ?></td>
                    <td><?= $row['stok']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <!-- TABEL BARANG -->




    <!-- TABEL DETAIL Pembelian -->
    <h2>Detail Pembelian</h2>
    <a href="tambah_pembelian.php"> tambah</a>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result_detail)) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row['nama_barang']; ?></td>
                    <td><?= $row['jml_barang']; ?></td>
                    <td><?= $row['sub_tot']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <!-- TABEL DETAIL PEMBELIAN -->
</body>
</html>
