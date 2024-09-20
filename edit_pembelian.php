<?php
include 'config.php';

if (isset($_POST['id_pem']) && isset($_POST['tot_belanja']) && isset($_POST['uang_bayar'])) {
    $id_pem = $_POST['id_pem'];
    $tot_belanja = $_POST['tot_belanja'];
    $uang_bayar = $_POST['uang_bayar'];

    // Hitung kembalian
    $kembalian = $uang_bayar - $tot_belanja;
    $total = $tot_belanja + $tot_belanja;
    // Query untuk mengupdate total belanja, uang bayar, dan kembalian
    $query = "UPDATE master_pembelian SET 
                tot_belanja = '$tot_belanja', 
                uang_bayar = '$uang_bayar', 
                kembalian = '$kembalian' 
              WHERE id_pem = '$id_pem'";

    if (mysqli_query($conn, $query)) {
        // Redirect ke halaman list_pembelian setelah berhasil update
        header("Location: list_pembelian.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
