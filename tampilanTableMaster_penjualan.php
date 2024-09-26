<?php

include 'config.php';

$sql = "SELECT * FROM master_penjualan";
$result = $conn->query($sql);

if($result->num_rows > 0){
    echo "<table border = '1' cellspacing='0' cellpadding='5'>";
    echo "<tr>";
    echo "<th>ID Penjualan</th>";
    echo "<th>ID User</th>";
    echo "<th>Total Belanja</th>";
    echo "<th>Uang Bayar</th>";
    echo "<th>Kembalian</th>";
    echo "<th>Cara Bayar</th>";
    echo "<th>Tgl Penjualan</th>";
    echo "<th>ID Kasir</th>";
    echo "</tr>";

    while ($row = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td>" . $row['id_penj'] . "</td>";
        echo "<td>" . $row['id_user'] . "</td>";
        echo "<td>" . $row['tot_belanja'] . "</td>";
        echo "<td>" . $row['uang_bayar'] . "</td>";
        echo "<td>" . $row['kembalian'] . "</td>";
        echo "<td>" . $row['cara_bayar'] . "</td>";
        echo "<td>" . $row['tgl_beli'] . "</td>";
        echo "<td>" . $row['id_kasir'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
}

?>