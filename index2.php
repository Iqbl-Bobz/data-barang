<?php

include 'config.php';

$query = "SELECT * FROM barang limit 2,4";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang | MOCHiQBAL</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body style="background-color: #1A2335">  
    
    <div class="title bg-primary">
        <h1 class="text-center text-light"> PENGELOLAAN DATA BARANG by <span>MOCHiQBAL</span></h1>
    </div> <br>
    <a href="tambah.php">
        <input type="button" value="[+] BARANG" class="btn btn-light fs-5 w-20 ms-2 mb-4">
    </a> <br> 
    <table border="1" cellpadding="10" cellspacing="0" class="table table-primary table-striped-columns ">
       <thead class="table-dark">

           <tr>
               <th>No.</th>
               <th>Nama Barang</th>
               <th>Harga</th>
               <th>Stok</th>
               <th>Aksi</th>
            </tr>
        </thead>

        <tbody class="text-center">
            <tr >
                    <?php $i = 1; while ( $row = mysqli_fetch_assoc($result)) : ?>
                    <td><?= $i++; ?></td>
                    <td><?= $row['nama_barang']; ?></td>
                    <td><?= $row['harga']; ?></td>
                    <td><?= $row['stok']; ?></td>
                    <td>
                        <a href="edit.php?id_barang=<?= $row['id_barang'] ?>">EDIT</a> | 
                        <a href="hapus.php?id_barang=<?= $row['id_barang'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"> HAPUS</a>
                    </td>
                </tr>
                <?php endwhile; ?>
        </tbody>
    </table>
<br>
    <a href="list_pembelian.php"> 
    <input type="button" value="[<>] TRANSAKSI" class="btn btn-light fs-5 w-20 ms-2">    
    </a>

    <br>
    <br>
<!-- PAGINATION -->
<footer>

<nav aria-label="Page navigation example" class="d-flex justify-content-center">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="index.php" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="index.php">1</a></li>
    <li class="page-item"><a class="page-link" href="index2.php">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>

</footer>

<!-- PAGINATION -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>