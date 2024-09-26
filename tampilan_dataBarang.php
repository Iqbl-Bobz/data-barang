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
    <title>DATA BARANG YANG TERSEDIA</title>
</head>
<body>
    <a href="index.php"><input type="button" value="KEMBALI"></a>
    <h1> DATA BARANG YANG TERSEDIA </h1>

    <table border="1" cellpadding="10" cellspacing="0" style="text-align: center;">
        <tr>
            <th>No.</th>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Harga Per Unit  </th>
            <th>Stok</th>
            <th>Opsi</th>
        </tr>

        <tr>
            <?php $i=1; while ($row =mysqli_fetch_assoc($result)) : ?>
            <td> <?= $i++; ?></td>
            <td> <strong style="color: red;"><?= $row["id_barang"]; ?></strong> </td>
            <td> <?= $row["nama_barang"];?></td>
            <td> Rp. <?= $row["harga"]; ?></td>
            <td><?= $row["stok"];?></td>
            <td>
                <a href="edit_barang.php?id_barang=<?= $row["id_barang"]; ?>">Edit</a> |
                <a href="hapus_barang.php?id_barang=<?= $row["id_barang"]; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');">Hapus</a>
            </td>
        </tr>

        <?php endwhile ?>
    </table>
    <a href="tambahkan_barang.php"><input type="button" value="[+]TAMBAHKAN BARANG [+]"></a>
</body>
</html>