<?php

include 'config.php';

// jika form di submit maka tambahkan data ke table barang
// cek jika form di submit (dengan method POST) maka tambahkan data ke table barang
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $sql = "INSERT INTO barang (nama_barang, harga, stok) VALUES ('$nama_barang', '$harga', '$stok')";
    if ($conn->query($sql) === TRUE) {
        echo "BERHASIL DITAMBAHKAN!";
    } else {
        echo "ERROR :(" . $conn->error;
    }
}

?>

<h1> TAMBAHKAN BARANG KE TABLE barang</h1>

<form action="" method="POST">
    Nama Barang : <input type="text" name="nama_barang" required> <br>
    Harga 1 Unit : <input type="number" name="harga" required> <br>
    Stok : <input type="number" name="stok" required> <br>
    <button type="submit"> [+] TAMBAHKAN [+] </button>

</form>
<a href="tampilan_dataBarang.php"><input type="button" value="KEMBALI"></a>