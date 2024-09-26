<?php 

include 'config.php';

$id_barang = $_GET['id_barang'];

$query = "SELECT * FROM barang WHERE id_barang = $id_barang";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if(isset($_POST['submit'])){
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $query = "UPDATE barang SET nama_barang = '$nama_barang', harga = '$harga', stok = '$stok' WHERE id_barang = $id_barang";
    mysqli_query($conn, $query);

    header("Location: tampilan_dataBarang.php");

}
?>


<h1> EDIT / UPDATE BARANG</h1>

<form action="" method="POST">
    
    Nama Barang : <input type="text" name="nama_barang" value="<?= $data['nama_barang']; ?>" required> <br>
    Harga 1 Unit : <input type="number" name="harga" value=" <?= $data['harga']; ?>" required> <br>
    Stok : <input type="number" name="stok" value="<?= $data['stok']; ?>" required> <br>
    <input type="submit" value="[+] UPDATE [+]" name="submit">

    
</form>