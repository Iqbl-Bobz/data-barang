<?php
include 'config.php';
$id_barang = $_GET['id_barang'];
$query = "DELETE FROM barang WHERE id_barang = $id_barang";
mysqli_query($conn, $query);

header("Location: index.php");
?>
