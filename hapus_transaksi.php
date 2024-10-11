<?php
include 'config.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_barang = $_POST['id_barang']; // Ambil id_barang dari form
    $id_penju = $_POST['id_penju']; // Ambil id_penju dari form

    // Ambil jumlah barang yang akan dihapus
    $check_sql = "SELECT jml_barang FROM detail_penjualan WHERE id_barang = ? AND id_penju = ?";
    $stmt_check = $conn->prepare($check_sql);
    $stmt_check->bind_param('ii', $id_barang, $id_penju);
    $stmt_check->execute();
    $check_result = $stmt_check->get_result();

    if ($check_result && $check_result->num_rows > 0) {
        $row = $check_result->fetch_assoc();
        $jml_barang_lama = $row['jml_barang'];

        // Hapus barang dari detail_penjualan
        $delete_sql = "DELETE FROM detail_penjualan WHERE id_barang = ? AND id_penju = ?";
        $stmt_delete = $conn->prepare($delete_sql);
        $stmt_delete->bind_param('ii', $id_barang, $id_penju);
        $stmt_delete->execute();

        // Tambah kembali stok di tabel barang
        $update_barang_sql = "UPDATE barang SET stok = stok + ? WHERE id_barang = ?";
        $stmt_update_barang = $conn->prepare($update_barang_sql);
        $stmt_update_barang->bind_param('ii', $jml_barang_lama, $id_barang);
        $stmt_update_barang->execute();
    }

    // Redirect atau refresh halaman
    header("Location: memilih_barang.php?id_penj=$id_penju");
    exit();
} else {
    echo "Data tidak lengkap.";
}
?>
