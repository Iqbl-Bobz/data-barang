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
    <title>Data Barang | MOCHiQBAL</title>
</head>

<body>  
    <h1> PENGELOLAAN DATA BARANG by MOCHiQBAL</h1>

    <a href="tambah.php">Tambah Data Barang</a>
    <table border="1" cellpadding="10" cellspacing="0">
       <thead>

           <tr>
               <th>No.</th>
               <th>Nama Barang</th>
               <th>Harga</th>
               <th>Stok</th>
               <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 1; while ( $row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row['nama_barang']; ?></td>
                    <td><?= $row['harga']; ?></td>
                    <td><?= $row['stok']; ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>">EDIT</a>
                        <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"> HAPUS</a>
                    </td>
                </tr>
                <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>