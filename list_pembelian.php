<?php
include 'config.php';

$query = "SELECT * FROM master_pembelian";
$result = mysqli_query($conn, $query);

$total_query = "SELECT SUM(tot_belanja) AS Total_Belanja FROM master_pembelian";
$total_result = mysqli_query($conn, $total_query);
// if(!$total_result) {
//     die(" error: " . mysqli_error($conn));    
// }
$total_row = mysqli_fetch_assoc($total_result);
$tot_belanja = $total_row['Total_Belanja'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Pembelian</title>
</head>
<body>
    <a href="index.php">
        <input type="button" value="< KEMBALI">
    </a>
    <h1>Daftar Pembelian</h1>
    <a href="transaksi.php">
        <input type="button" value="+"> Tambah
    </a>
    <table border="1" cellspacing="0" cellpadding="8" style="text-align: center;">
        <tr>
            <th>ID Pembelian</th>

            <th>ID User</th>
            <th>Total Belanja</th>
            <th>Uang Bayar</th>
            <th>Kembalian</th>
            <th>Cara Bayar</th>
            <th>Tanggal Beli</th>
            <th>ID Kasir</th>

        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?php echo $row['id_pem']; ?></td>
            <td><?php echo $row['id_user']; ?></td>
            <td>
                <form action="edit_pembelian.php" method="POST">
                    <input type="hidden" name="id_pem" value="<?php echo $row['id_pem']; ?>">
                    <input type="number" name="tot_belanja" value="<?php echo $row['tot_belanja']; ?>" 
                    style="width: 100px" required>
                    <input type="submit" value="EDIT">
                </td>
                <td>
                    <input type="number" name="uang_bayar" value="<?php echo $row['uang_bayar']; ?>" style="width: 100px" required>
                    <input type="submit" value="EDIT">
                </form>
            </td>
            <td><?php echo $row['kembalian']; ?></td>
            <td><?php echo $row['cara_bayar']; ?></td>
            <td><?php echo $row['tgl_beli']; ?></td>
            <td><?php echo $row['id_kasir']; ?></td>
            
        </tr>
        <?php endwhile; ?>
    </table>
    <strong>TOTAL BAYAR : <?php 
        echo "Rp. " . number_format($tot_belanja, 2, ) ;
    ?></strong>
    <a href="list_detail_pembelian.php"> LIST DETAIL PEMBELIAN</a>
</body>
</html>
