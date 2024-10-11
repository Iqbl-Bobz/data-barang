<?php
include 'config.php';  // Koneksi ke database

// Mendapatkan data dari form
$id_barang = $_POST['id_barang'];
$id_penju = $_POST['id_penju'];
$jml_barang = $_POST['jml_barang'];

// Validasi input, pastikan variabel terisi
if (isset($id_barang) && isset($id_penju) && isset($jml_barang)) {

    // Ambil harga barang dan stok dari tabel barang
    $sql_harga = "SELECT harga, stok FROM barang WHERE id_barang = $id_barang";
    $result_harga = $conn->query($sql_harga);

    if ($result_harga && $result_harga->num_rows > 0) {
        $row_harga = $result_harga->fetch_assoc();
        $harga_barang = $row_harga['harga'];
        $stok_awal = $row_harga['stok'];

        // Ambil jumlah barang sebelumnya dari tabel detail_penjualan
        $sql_jml_barang = "SELECT jml_barang FROM detail_penjualan WHERE id_barang = $id_barang AND id_penju = $id_penju";
        $result_jml_barang = $conn->query($sql_jml_barang);
        $jml_barang_sebelumnya = 0;

        if ($result_jml_barang && $result_jml_barang->num_rows > 0) {
            $row_jml_barang = $result_jml_barang->fetch_assoc();
            $jml_barang_sebelumnya = $row_jml_barang['jml_barang'];
        }

        // Hitung subtotal baru
        $sub_tot = $jml_barang * $harga_barang;

        // Update jumlah barang dan subtotal di tabel detail_penjualan
        $sql_update = "UPDATE detail_penjualan SET jml_barang = $jml_barang, sub_tot = $sub_tot WHERE id_barang = $id_barang AND id_penju = $id_penju";
        
        if ($conn->query($sql_update) === TRUE) {
            // Hitung stok baru berdasarkan perubahan
            $stok_baru = $stok_awal - $jml_barang + $jml_barang_sebelumnya; // Mengurangi jumlah baru dan menambahkan jumlah sebelumnya
            $sql_stok = "UPDATE barang SET stok = $stok_baru WHERE id_barang = $id_barang";
            $conn->query($sql_stok);

            // Redirect kembali ke halaman memilih barang setelah berhasil update
            header("Location: memilih_barang.php?id_penj=$id_penju");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Barang tidak ditemukan.";
    }
} else {
    echo "Data tidak lengkap.";
}
?>
