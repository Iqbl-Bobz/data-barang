<?php

// koneksi ke database
include 'config.php';

$id_penj = $_GET['id_penj'];

// ambil data detail penjualan untuk update stok barang
$sql = "SELECT id_barang, jml_barang FROM detail_penjualan WHERE id_penju = '$id_penj' ";
$result = $conn->query($sql);   


// update stok barang yang dibatalkan
while ($row = $result->fetch_assoc()) {
    // dapatkan id_barang dan jumlah barang yang dibatalkan
    // dari table detail_penjualan
    $id_barang = $row['id_barang'];
    $jml_barang_cancel = $row['jml_barang'];
 
    // update stok barang yang dibatalkan di table barang
    // dengan cara menambahkan jumlah barang yang dibatalkan
    // ke stok yang sebelumnya ada di table barang
    
    $sql_update_stok = "UPDATE barang SET stok = stok + $jml_barang_cancel WHERE id_barang = $id_barang";
    $conn->query($sql_update_stok);

}


$sql = "DELETE FROM detail_penjualan WHERE id_penju = $id_penj";
$conn->query($sql);

$sql = "DELETE FROM master_penjualan WHERE id_penj = $id_penj";
$conn->query($sql);

// setelah transaksi dibatalkan, arahkan user ke halaman utama aplikasi lagi
header("Location: index.php");

?>