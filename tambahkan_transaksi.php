<?php
include 'config.php';

// Buat transaksi baru di master_penjualan
$sql = "INSERT INTO master_penjualan (id_user, id_kasir) VALUES (1, 1)"; // Sesuaikan dengan user/kasir
if ($conn->query($sql) === TRUE) {
    $id_penj = $conn->insert_id; // Dapatkan ID penjualan yang baru saja dibuat
    header("Location: memilih_barang.php?id_penj=$id_penj"); // Arahkan ke halaman pemilihan barang
} else {
    echo "Error: " . $conn->error;
}
?>