<?php

include 'config.php';

<<<<<<< HEAD
$query = "SELECT * FROM barang ";
=======
$query = "SELECT * FROM barang";
>>>>>>> 7374f9db96640ca75780cce452db8ccd5f184c13
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

<<<<<<< HEAD
    <a href="tambah.php">[+ BARANG]</a> <br> <br>
=======
    <a href="tambah.php">Tambah Data Barang</a>
>>>>>>> 7374f9db96640ca75780cce452db8ccd5f184c13
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
<<<<<<< HEAD
                        <a href="edit.php?id=<?= $row['id_barang'] ?>">EDIT</a>
                        <a href="hapus.php?id=<?= $row['id_barang'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"> HAPUS</a>
=======
                        <a href="edit.php?id=<?= $row['id'] ?>">EDIT</a>
                        <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"> HAPUS</a>
>>>>>>> 7374f9db96640ca75780cce452db8ccd5f184c13
                    </td>
                </tr>
                <?php endwhile; ?>
        </tbody>
    </table>
<<<<<<< HEAD
    <a href="#">  <prev> << Prev  </prev> <next> 123...Next>></next> </a>
=======
>>>>>>> 7374f9db96640ca75780cce452db8ccd5f184c13
</body>
</html>