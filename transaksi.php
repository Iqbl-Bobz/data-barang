<?php
include 'config.php';

$query = "SELECT * FROM master_pembelian";
$result = mysqli_query($conn, $query);

$query = "SELECT * FROM barang";
$result = mysqli_query($conn, $query);

if (isset($_POST['submit'])) {
    $id_pem = $_POST['id_pem'];
    $id_user = $_POST['id_user'];
    $tot_belanja = $_POST['tot_belanja'];
    $uang_bayar = $_POST['uang_bayar'];
    $kembalian = $uang_bayar - $tot_belanja;
    $cara_bayar = $_POST['cara_bayar'];
    $tgl_beli = $_POST['tgl_beli'];
    $id_kasir = $_POST['id_kasir'];

    $query = "INSERT INTO master_pembelian (id_pem, id_user, tot_belanja, uang_bayar, kembalian, cara_bayar, tgl_beli, id_kasir)
              VALUES ('$id_pem', '$id_user', '$tot_belanja', '$uang_bayar', '$kembalian', '$cara_bayar', '$tgl_beli', '$id_kasir')";

    if (mysqli_query($conn, $query)) {
        header(header: "Location: list_pembelian.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pembelian</title>
</head>
<body>
    <a href="list_pembelian.php">
        <input type="button" value="< KEMBALI">
    </a>
    <h1>Tambah Pembelian</h1>
    <form action="" method="POST">
        <!-- FORM PEMBELIAN -->
        <label for="id_pem"> ID Pembelian</label> 
        <input type="number" name="id_pem" id="id_pem" required> <br>
        <label for="id_user">ID User:</label>
        <select name="id_user" id="id_user">
            <option value="NON-VIP">NON-VIP</option>
            <option value="NON-VIP">VIP</option>
        </select>
        <br>
        <label for="tot_belanja">Total Belanja:</label>
        <input type="number" step="0.01" name="tot_belanja" id="tot_belanja" required>
        <br>
        <label for="uang_bayar">Uang Bayar:</label>
        <input type="number" step="0.01" name="uang_bayar" id="uang_bayar" required>
        <br>
        <label for="cara_bayar">Cara Bayar:</label>
        <select name="cara_bayar" id="cara_bayar">
            <option value="Cash">Cash</option>
            <option value="E-Wallet">E-Wallet</option>
        </select>
        <br>
        <label for="tgl_beli">Tanggal Beli:</label>
        <input type="date" name="tgl_beli" id="tgl_beli" required>
        <br>
        <label for="id_kasir">ID Kasir:</label>
        <input type="number" name="id_kasir" id="id_kasir" required>
        <br>
        <button type="submit" name="submit">Tambah Pembelian</button>
        <!-- FORM MASTER_PEMBELIAN -->

        <!-- FORM DETAIL_PEMBELIAN -->
        

        <!-- FORM DETAIL_PEMBELIAN -->
    </form>
    <br> <br>




    <!-- REFRENSI DATABASE -->
    <table border="1" cellpadding="10" cellspacing="0">
       <thead>

           <tr>
               <th>id Barang</th>
               <th>Nama Barang</th>
               <th>Harga</th>
               <th>Stok</th>
          </tr>
        </thead>

        <tbody>
            <tr>
                <?php while($row = mysqli_fetch_assoc($result)) : ?>
                    <td><?= $row['id_barang'] ?></td>
                    <td><?= $row['nama_barang']; ?></td>
                    <td><?= $row['harga']; ?></td>
                    <td><?= $row['stok']; ?></td>
                    
                </tr>
                <?php endwhile; ?>
        </tbody>
    </table>

    
</body>
</html>
