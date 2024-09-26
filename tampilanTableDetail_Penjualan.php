<?php 

include 'config.php';

$sql = "SELECT * FROM detail_penjualan";
$result = $conn->query($sql);

echo "<input type='button' value='KEMBALI' onclick='history.back()'>";
if($result->num_rows > 0 ){
    echo "<table border = '1' cellspacing='0' cellpadding='5'>";
    echo "<tr>";
    echo "<th>ID Detail</th>";
    echo "<th>ID Penjualan</th>";
    echo "<th>ID Barang</th>";
    echo "<th>Jumlah Barang</th>";
    echo "<th>Sub Total</th>";
    echo "</tr>";
    
    while ($row = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td>" . $row['id_detail'] . "</td>";
        echo "<td>" . $row['id_penju'] . "</td>";
        echo "<td>" . $row['id_barang'] . "</td>";
        echo "<td>" . $row['jml_barang'] . "</td>";
        echo "<td>" . $row['sub_tot'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

?>

    