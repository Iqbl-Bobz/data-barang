<?php

include 'config.php';

$id_barang = $_GET['id_barang'];

$sql = "DELETE FROM barang WHERE id_barang = $id_barang";
if ($conn->query($sql) === TRUE) {
    header("Location: tampilan_dataBarang.php");  
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>