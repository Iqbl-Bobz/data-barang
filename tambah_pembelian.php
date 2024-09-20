<?php

include 'config.php';

if(isset($_POST['submit'])) {
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $tot_belanja = $_POST['tot_belanja'];
    $uang_bayar =  $_POST['uang_bayar'];
    $kembalian = $uang_bayar - $tot_belanja;

    $query_pembelian = "INSERT INTO master_pembelian (id_user, tot_belanja, uang_bayar, kembalian, cara_bayar, tgl_beli, id_kasir) VALUES ('$id_user', '$tot_belanja', '$uang_bayar', '$kembalian', '$cara_bayar', NOW(), '$id_kasir')";
    mysqli_query($conn, $query_pembelian);

    $id_pemb = mysqli_insert_id($conn);

    $id_barang = $_POST['id_barang'];
    $jml_barang = $_POST ['jml_barang'];

    $query_barang = "SELECT harga FROM barang WHERE id_barang = '$id_barang'";
    $result = mysqli_query($conn, $query_barang);
    $row = mysqli_fetch_assoc($result);
    $harga = $row['harga'];
    $sub_tot = $jml_barang * $harga;

    $query_detail = "INSERT INTO detail_pembelian(id_pemb, id_barang, jml_barang, sub_tot) VALUES 
    ('$id_pemb', '$id_barang', '$jml_barang', '$sub_tot')";
    mysqli_query($conn,$query_detail);



    $query = "INSERT INTO detail_pembelian (id_pemb,id_barang, jml_barang,sub_tot) VALUES ('$id_pemb', '$id_barang', '$jml_barang','$sub_tot')";
    mysqli_query($conn, $query);

    $id_barang = mysqli_insert_id($conn);

    $id_pemb = 1;

    $jml_barang = 5;    
    $sub_tot = $jml_barang * $harga;

    $query = "INSERT INTO detail_pembelian (id_pemb, id_barang, jml_barang, sub_tot) VALUES ('$id_pemb', '$id_barang', '$jml_barang', '$sub_tot')";
    mysqli_query($conn, $query);

    header("Location: list_detail_pembelian.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAMBAH BARANG DAN Detail</title>
</head>
<body>
    <a href="list_detail_pembelian.php">
        <input type="button" value="< KEMBALI">
    </a>
    <h1> TAMBAH BARANG</h1>
    <form action="" method="POST">
    <!-- Data Pembelian -->
    <label for="tot_belanja">Total Belanja:</label>
    <input type="number" name="tot_belanja" id="tot_belanja" required>
    <br>
    <label for="uang_bayar">Uang Bayar:</label>
    <input type="number" name="uang_bayar" id="uang_bayar" required>
    <br>
    <label for="cara_bayar">Cara Bayar:</label>
    <select name="cara_bayar" id="cara_bayar">
        <option value="Cash">Cash</option>
        <option value="Transfer">Transfer</option>
    </select>
    <br>

    <!-- Data Barang yang Dibeli -->
    <label for="id_barang">ID Barang:</label>
    <input type="number" name="id_barang" id="id_barang" required>
    <br>
    <label for="jml_barang">Jumlah Barang:</label>
    <input type="number" name="jml_barang" id="jml_barang" required>
    <br>
    
    <button type="submit" name="submit">Simpan Pembelian</button>
</form>

</body>
</html>