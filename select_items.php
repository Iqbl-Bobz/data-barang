<?php
include 'config.php';

$id_penj = $_GET['id_penj']; // Dapatkan ID transaksi

// Proses menambahkan barang ke detail_penjualan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];

    // Ambil harga barang
    $sql = "SELECT harga FROM barang WHERE id_barang = $id_barang";
    $result = $conn->query($sql);
    $barang = $result->fetch_assoc();
    $sub_tot = $barang['harga'] * $jumlah;

    #AMBIL STOK BARANG DARI TABEL BARANG
    $sql  = "SELECT stok, harga FROM barang WHERE id_barang = '$id_barang'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $stok_tersedia = $row['stok'];
    $harga = $row['harga'];

    #VALIDASI STOK
    if($stok_tersedia <= 0) {
        echo "Stok habis dan tidak bisa dibeli!";
    } elseif($jumlah > $stok_tersedia){
        echo "Jumlah yang dibeli melebihi stok bro!";
    } else {
        $sub_tot = $jumlah * $harga;
       
        // Masukkan ke detail_penjualan
        $sql_insert = "INSERT INTO detail_penjualan (id_penju, id_barang, jml_barang, sub_tot) 
                VALUES ('$id_penj', '$id_barang', '$jumlah', '$sub_tot')";
        if($conn->query($sql_insert) === TRUE) {
            echo "";
        }else{
            echo "Yahh barang nggak berhasil ditambahkan :(" . $conn->error ;
        }
    
        // Update stok barang
        $sql = "UPDATE barang SET stok = stok - '$jumlah' WHERE id_barang = '$id_barang'";
        $conn->query($sql);
    }

}


// PROSES PENYELESAIAN TRANSAKSI

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['finish_transaction'])){
    $uang_bayar = $_POST['uang_bayar']; #AMBIL UANG BAYAR DARI FORM
    #HITUNG TOTAL BELANJA DARI DETAIL PENJUALAN
    $sql = "SELECT SUM(sub_tot) AS total FROM detail_penjualan WHERE id_penju =$id_penj";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total_belanja = $row['total'];

    $kembalian = $uang_bayar - $total_belanja;

    if($kembalian < 0){
        $error_message = "Uang bayar tidak cukup!";
    }else{
        $sql = "UPDATE master_penjualan SET tot_belanja = '$total_belanja', uang_bayar = '$uang_bayar',
        kembalian = '$kembalian' WHERE id_penj = $id_penj";
        $conn->query($sql);

        $transaction_complete = true;
    }

}

$query = "SELECT * FROM master_penjualan";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

// Tampilkan daftar barang
$sql = "SELECT * FROM barang";
$result = $conn->query($sql);



?>

<h1>Pilih Barang untuk Transaksi</h1>
<table border="1">
    <tr>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Tambah</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <form method="POST">
            <input type="hidden" name="id_barang" value="<?php echo $row['id_barang']; ?>">
            <td><?php echo $row['nama_barang']; ?></td>
            <td><?php echo $row['harga']; ?></td>
            <td><?php echo $row['stok']; ?></td>
            <td>
                <input type="number" name="jumlah" value="0" min="0" max="<?php echo $row['stok']; ?>">
                <button type="submit" name="submit">Tambahkan</button>
            </td>
        </form>
    </tr>
    <?php endwhile; ?>
</table>

<form action="" method="POST">
    <h2> TOTAL BELANJA Rp. 
        <?php 
        $sql = "SELECT SUM(sub_tot) AS total FROM detail_penjualan WHERE id_penju = $id_penj";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo $row['total'];
        ?>
    </h2>
    Uang Bayar : <input type="number" name="uang_bayar" id="uang_bayar" required> 
    <button type="submit" name="finish_transaction">BAYAR</button>

</form>

<?php if(isset($transaction_complete) && $transaction_complete): ?>
    <h2> TRANSAKSI SELESAI</h2>
    <p>Total Belanja : <u> Rp. <?php  echo $total_belanja;?> </u></p>
    <p>Uang Bayar : <u> Rp. <?php echo $uang_bayar;?> </u></p>
    <p>Kembalian : <u> Rp. <?php echo $kembalian;?></u> <br></p>
    <p>ID USER : <u><?= $data['id_user']; ?> </u></p>
    <a href="add_transaction.php">SELESAIKAN DAN MULAI TRANSAKSI BARU!</a>
    <?php elseif (isset($error_message)): ?>
        <h1><?php echo $error_message;?></h1>
<?php endif; ?>


<a href="cancel_transaction.php?id_penj=<?php echo $id_penj; ?>">Batalkan Transaksi</a>