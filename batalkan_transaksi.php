<?php

include 'config.php';

$id_penj = $_GET['id_penj'];

$sql = "SELECT id_barang, jml_barang FROM detail_penjualan WHERE id_penju = '$id_penj' ";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()){
    $id_barang = $row['id_barang'];
    $jml_barang_cancel = $row['jml_barang'];

    $sql_update_stok = "UPDATE barang SET stok = stok + $jml_barang_cancel WHERE id_barang = $id_barang";
    $conn->query($sql_update_stok);

}


$sql = "DELETE FROM detail_penjualan WHERE id_penju = $id_penj";
$conn->query($sql);

$sql = "DELETE FROM master_penjualan WHERE id_penj = $id_penj";
$conn->query($sql);

header("Location: index.php");

?>