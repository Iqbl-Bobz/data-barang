<?php

include 'config.php';

$id_barang = $_GET['id_barang'];

// hapus data barang dari table barang berdasar id_barang yang dikirimkan lewat url
$sql = "DELETE FROM barang WHERE id_barang = $id_barang";
// jika berhasil menghapus data barang dari table barang maka arahkan user ke halaman tampilan_dataBarang.php
if ($conn->query($sql) === TRUE) {
        header("Location: tampilan_dataBarang.php");  
} else {
    echo "Gagal menghapus data: " . $conn->error; // menampilkan error pesan jika gagal menghapus data barang dari table barang
}
?>