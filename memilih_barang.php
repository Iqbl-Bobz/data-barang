<?php
include 'config.php';

if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['id_penj'])) {
    // Buat transaksi baru di master_penjualan
    $sql = "INSERT INTO master_penjualan (id_user, id_kasir) VALUES (1, 1)";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['id_penj'] = $conn->insert_id;
    } else {
        echo "Error: " . $conn->error;
        exit();
    }
}

// Dapatkan ID transaksi yang sedang dibuat dari URL
$id_penj = $_GET['id_penj']; 

// Proses menambahkan barang ke detail_penjualan ketika form di submit
// Jika form untuk menambahkan barang di submit, maka tambahkan barang ke detail_penjualan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {



    // Ambil ID barang dan jumlah barang yang dipilih dari form
    $id_barang = $_POST['id_barang']; // Ambil ID barang yang dipilih dari form
    $jumlah = $_POST['jumlah']; // Ambil jumlah barang yang dipilih dari form

    // Ambil harga barang
    $sql = "SELECT harga FROM barang WHERE id_barang = $id_barang";
    $result = $conn->query($sql);
    $barang = $result->fetch_assoc();
    $sub_tot = $barang['harga'] * $jumlah;

    #AMBIL STOK BARANG DARI TABEL BARANG
    $sql  = "SELECT stok, harga FROM barang WHERE id_barang = '$id_barang'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    // Ambil stok yang tersedia dan harga dari hasil query diatas
    // $row['stok'] berisi stok yang tersedia, $row['harga'] berisi harga barang
    $stok_tersedia = $row['stok'];
    $harga = $row['harga'];

    // Cek apakah stok tersedia
    if($stok_tersedia <= 0) {
        echo "Stok habis, tidak bisa dibeli!";
       } 
    // Cek apakah jumlah yang dibeli melebihi stok yang tersedia
    elseif($jumlah > $stok_tersedia){
        echo "Jumlah yang dibeli melebihi stok yang tersedia!";
    } 
    // Jika stok tersedia dan jumlah yang dibeli tidak melebihi stok, maka hitung sub total
    else {
        $sub_tot = $jumlah * $harga;
       
      
        // syntax ini digunakan untuk insert data ke table detail_penjualan
        // dengan isi id_penju, id_barang, jml_barang dan sub_tot
        // jika berhasil maka tidak ada respon
        // jika gagal maka akan muncul pesan error
        $sql_insert = "INSERT INTO detail_penjualan (id_penju, id_barang, jml_barang, sub_tot) 
                VALUES ('$id_penj', '$id_barang', '$jumlah', '$sub_tot')";
        if($conn->query($sql_insert) === TRUE) {
            echo "";
        }else{
            echo "Yahh barang nggak berhasil ditambahkan :(" . $conn->error ;
        }

        $sql_caraBayar = "INSERT INTO master_penjualan (cara_bayar)";

        // Update stok barang
        // Kurangi stok barang sejumlah $jumlah dari table barang
        // berdasar id_barang yang dipilih
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


    // Jika uang bayar kurang dari total belanja, maka tampilkan pesan error
    if($kembalian < 0){
        $error_message = "Uang bayar tidak cukup!";
    }else{
        // Update table master_penjualan dengan total belanja, uang bayar dan kembalian
        // berdasar id_penj yang sedang diproses
        $sql = "UPDATE master_penjualan SET tot_belanja = '$total_belanja', uang_bayar = '$uang_bayar',
        kembalian = '$kembalian' WHERE id_penj = $id_penj";
        $conn->query($sql);

        // Set variabel $transaction_complete menjadi true
        // untuk menandai bahwa transaksi telah selesai
        // dan transaksi dapat ditutup
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
<!-- Deklarasi dokumen HTML5, berisi informasi tentang isi halaman yang akan ditampilkan -->
<!DOCTYPE html>    
<html lang="en"> <!-- Deklarasi bahwa dokumen ini menggunakan bahasa Inggris -->
<head>
    <meta charset="UTF-8"> <!-- Membuat agar tampilan tulisan tidak berantakan -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- syntax di atas digunakan untuk membuat tampilan web kita responsive, yaitu dapat menyesuaikan ukuran layar perangkat yang digunakan untuk mengakses web kita. -->
    <title>TRANSAKSI | &copy; MOCHiQBAAL</title>
</head>
<body>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="style/style.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wdth,wght@0,75..100,300..800;1,75..100,300..800&display=swap" rel="stylesheet">
</head>
<body style="background-color: rgb(236, 232, 222);">


<header class="header justify-content-start bg-primary navbar-expand-xl navbar">
    <h5 class="text-light text-sm-center nav-item mx-auto">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Necessitatibus, quia.</h5>
</header>

    <!-- BAGIAN NAVBAR -->
    <nav class="nav navbar-expand-xl fs-4 w-25 bg-secondary flex-column d-flex justify-content-start align-items-center custom-navbar">    
    <figure class="text-center ">
           <a href="index.php">
               <img src="assets/logo.jpg" alt="MochIqbal" class="rounded-circle w-50 mt-2 m-1" title="MOCHiQBAAL">
            </a>
               <figcaption class="fs-3 fw-semibold text-light ">MochIqbaal</figcaption>
            <figcaption class="fs-5  fw-semibold text-light">( 121404 )</figcaption>
        </figure>

        <ul class="nav justify-content-start flex-column mt-2 " >
            <li class="nav-item text-center z-2">
                <a class="nav-link active text-dark fw-semibold " aria-current="page" href="tampilan_dataBarang.php"><i class="fa-solid fa-desktop fs-4" title="Master"></i> Master</a>
            </li>
            <li class="nav-item text-center z-3">
                <a class="nav-link text-dark fw-semibold" href="tambahkan_transaksi.php"><i class="fa-solid fa-cart-shopping fs-4" title="Transaksi"></i> Transaksi</a>
            </li>
            <li class="nav-item text-center z-3">
                <a class="nav-link text-dark  fw-semibold " href="Dashboard.php"><i class="fa-solid fa-clipboard fs-4" title="Dashboard"></i> Dashboard</a>
            </li>
        </ul>

</nav>
<!-- BAGIAN NAVBAR -->
 
<div class="container position-relative top-50 start-50 translate-middle" style="margin-top: -350px;">
    <div class="position-absolute top-0 start-50 translate-middle"></div>
            <div class="border-4 float-end position-sticky p-1 mb-4  text-body border-start  bg-warning-subtle border-warning w-75   ">
                <h4 class="text-start  ">  TRANSAKSI</h4>
            </div>

<table border="1" style="margin-bottom: 10px;"  class="table  table-striped table-secondary w-25  float-right z-3 col-md-6 position-static  ">
    <tr class="table-dark col-md-6">
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Tambah</th>
    </tr>
    <!-- syntax ini digunakan untuk mengulang setiap data yang ada di dalam tabel barang -->
    <!-- dan menampilkan setiap data tersebut dalam bentuk tabel -->
    <?php while($row = $result->fetch_assoc()): ?>    
        <!-- Syntax ini digunakan untuk membuat form yang akan mengirimkan data ke server dengan menggunakan metode POST -->
        <form method="POST">
<!-- Membuat baris baru dalam tabel -->
        <tr>
        <!-- input type hidden digunakan untuk mengirimkan data id_barang ke server -->
        <input type="hidden" name="id_barang" value="<?php echo $row['id_barang']; ?>">
        <!-- menampilkan nama_barang -->
        <td><?php echo $row['nama_barang']; ?></td>
        <!-- menampilkan harga barang -->
        <td><?php echo $row['harga']; ?></td>
        <!-- menampilkan stok barang -->
        <td><?php echo $row['stok']; ?></td>
        <!-- membuat form untuk menginput jumlah barang yang ingin dibeli -->
        <td>
            <!-- input type number digunakan untuk menginputkan jumlah barang yang ingin dibeli -->
            <!-- min digunakan untuk mengatur nilai minimum yang dapat diinputkan -->
            <!-- max digunakan untuk mengatur nilai maksimum yang dapat diinputkan -->
            <input type="number" style="margin-right: 50px" class=" col-1 position-absolute  z-n1 end-0" name="jumlah" value="1" min="1" max="<?php echo $row['stok']; ?>">
            <!-- button type submit digunakan untuk me1girimkan data ke server -->
            <button type="submit"  name="submit" class="btn btn-primary">Tambahkan</button>
        </td>
         
    </tr>
        </form>
    <?php endwhile; // syntax ini digunakan untuk mengulang setiap data yang ada di dalam tabel barang ?>
</table> 


<!-- Syntax ini digunakan untuk membuat form yang akan mengirimkan data ke server dengan menggunakan metode POST -->

<form action="" method="POST">
    <!-- Syntax ini digunakan untuk menampilkan total belanja yang harus dibayar -->
    <h2 class="float-right mr-5 fs-5"> TOTAL BELANJA Rp. 
        <!-- Syntax ini digunakan untuk menghitung total belanja dari table detail_penjualan
        berdasar id_penj yang sedang diproses, dan menampilkan hasilnya -->
        <?php 
        // menghitung total belanja dari table detail_penjualan 
        // berdasar id_penj yang sedang diproses, dan menampilkan hasilnya
        $sql = "SELECT barang.id_barang, barang.nama_barang, detail_penjualan.jml_barang, detail_penjualan.sub_tot 
        FROM detail_penjualan
        JOIN barang ON detail_penjualan.id_barang = barang.id_barang
        WHERE detail_penjualan.id_penju = $id_penj";
$result = $conn->query($sql);

if ($result) {
    // Inisialisasi variabel untuk menghitung total
    $total = 0;
    while ($row = $result->fetch_assoc()) {
        $total += $row['sub_tot'];
    }
    echo $total;
}
        ?>
    </h2><br> <br> <br><br>
    
    <div class="row mb-2 ">
    <label for="uang_bayar" class="col-md-5  start-50  col-form-label fs-5">Uang Bayar : </label>
        <input type="number" class="form-control  col-md-5 mt-5 ml-5" name="uang_bayar" id="uang_bayar" required> <!-- input type number digunakan untuk menginputkan uang bayar -->
    </div>
        
    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
  <button type="submit" name="finish_transaction" class="btn btn-primary me-md-4 " type="submit" >BAYAR</button>
</div>

</form>



<!-- Syntax ini digunakan untuk mengecek apakah variabel $transaction_complete bernilai true atau tidak
// Jika true maka akan menampilkan pesan "TRANSAKSI SELESAI" dan detail transaksi
// Jika false maka akan menampilkan pesan error yang di set di variabel $error_message -->
<?php if(isset($transaction_complete) && $transaction_complete): ?>
    <div class="position-absolute top-50 end-0 translate-middle-y text-center bg-warning mr-3" style="margin-top: 420px;">
        <h2> TRANSAKSI SELESAI</h2>
        <p>Total Belanja : <u> Rp. <?php  echo $total_belanja;?> </u></p>
        <p>Uang Bayar : <u> Rp. <?php echo $uang_bayar;?> </u></p>
        <p>Kembalian : <u> Rp. <?php echo $kembalian;?></u> <br></p>
        <!-- <p>ID USER : <u><?= $data['id_user']; ?> </u></p> -->
        <button class="btn btn-success w-75 mb-4">
            <a href="tambahkan_transaksi.php" class="text-light fw-semibold" style="text-decoration: none;">SELESAIKAN DAN MULAI TRANSAKSI BARU!</a>
        </button>
    </div>
   
<?php elseif (isset($error_message)): ?>
    <h5 class="text-danger text-center" ><?php echo $error_message;?></h5>
<?php endif; ?>



<!-- TABEL BUAT NONGOLIN BARANG YANG UDAH DI TAMBAHIN -->
<!-- PR DIBAGIAN EDIT SAMA HAPUS -->

<?php
// Ambil barang dari detail_penjualan yang sudah ditambahkan ke transaksi ini
// Tampilkan barang yang sudah ada di transaksi
$sql = "SELECT barang.id_barang, barang.nama_barang, detail_penjualan.jml_barang, detail_penjualan.sub_tot 
FROM detail_penjualan
JOIN barang ON detail_penjualan.id_barang = barang.id_barang
WHERE detail_penjualan.id_penju = $id_penj";
$result = $conn->query($sql);

if ($result) {
$total = 0;
echo "<table border='1' class='table table-secondary table-striped w-75 float-end col-xl-4 mr-sm-5 mt-3'>
    <thead>
        <tr class='table table-secondary'>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>";

while ($row = $result->fetch_assoc()) {
$total += $row['sub_tot'];

echo "<tr>
        <td>{$row['nama_barang']}</td>

        <!-- Kolom Edit Jumlah Barang -->
        <td>
                    <form method='POST' action='edit_transaksi.php'>
                        <input type='hidden' name='id_barang' value='{$row['id_barang']}'>
                        <input type='hidden' name='id_penju' value='$id_penj'>
                        <input type='number' name='jml_barang' value='{$row['jml_barang']}'  min='1'>
                        <button type='submit'>Update</button>
                    </form>
                   
        </td>
        <!-- Kolom Subtotal -->
        <td>Rp. {$row['sub_tot']}</td>

        <!-- Tombol Hapus Barang -->
        <td>
            <form method='POST' action='hapus_transaksi.php'>
                <input type='hidden' name='id_barang' value='{$row['id_barang']}'>
                <input type='hidden' name='id_penju' value='$id_penj'>
                <button type='submit' onclick='return confirm(\"Yakin ingin menghapus barang ini?\")'>Hapus</button>
            </form>
        </td>
      </tr>";
}

echo "</tbody></table>";

// Tampilkan total belanja

} else {
echo "Error mengambil data barang: " . $conn->error;
}

?>
</div>    



<button class="btn btn-danger position-absolute bottom-0 start-0 ml-2 mt-5 col-md-2">
    <a href="batalkan_transaksi.php?id_penj=<?php echo $id_penj; ?>" class="link text-light text-decoration-none">Batalkan Transaksi</a>
</button>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

