<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  <!-- Membuat agar tampilan tulisan tidak berantakan -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Membuat agar tampilan web 
    dapat disesuaikan dengan ukuran layar gadget -->
    <title>APLIKASI POINT OF SALES | &copy; MOCHiQBAAL</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wdth,wght@0,75..100,300..800;1,75..100,300..800&display=swap" rel="stylesheet">
</head>
<body style="background-color: rgb(236, 232, 222);">

<div id="loading-screen"> 
        <div class="spinner-border text-primary" id="loading-spinner" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <!-- BAGIAN NAVBAR -->
    <nav class="bg-primary d-flex align-items-center justify-content-between ">
        <a href="">
            <img src="assets/logo.jpg" alt="MochiQBAL" width="55" class=" rounded-circle " > 
            </a>
            <ul class="nav fs-3  ">       
            <li class="nav-item">
                <a class="nav-link active text-light" aria-current="page" href="tampilan_dataBarang.php"><i class="fa-solid fa-desktop fs-4" title="Master"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="tambahkan_transaksi.php"><i class="fa-solid fa-cart-shopping fs-4" title="transaksi"></i> </a>
            </li>
        
  <li class="nav-item">
    <a class="nav-link text-light" href="dashboard.php"><i class="fa-solid fa-clipboard fs-4" title="Dashboard"></i> </a>
  </li>
  <!-- <li class="nav-item">
      <a class="nav-link disabled" aria-disabled="true">Disabled</a>
    </li> -->
</ul>
</nav>
<!-- BAGIAN NAVBAR -->
    
    <main>
        <div class="container">
            <h1 class="mt-5 text-center animate__animated animate__fadeInLeft animate__delay-2s">SELAMAT DATANG DI</h1>
            <h2 class="mt-5 text-center animate__animated animate__fadeInRight animate__delay-3s"> &copy; APLIKASI POINT OF SALES | <span>MOCHiQBAAL</span></h2>
            <div class="mt-4 text-title text-center">
                <p class="animate__animated animate__fadeIn animate__delay-4s mt-4"> Alamat : Lorem ipsum dolor sit amet. | Kontak : 08xxxxxxxx </p>
            </div>
            <div class="wrapper text-center d-inline">
                <div class="animate__animated animate__fadeIn animate__delay-5s mt-5 "> <h3 id="datetime"></h3>  </div>

            </div>
        </div>
    </main>

    <script>
        // FUNCTION MENAMPILKAN WAKTU
                function updateDateTime() {
            const date = new Date();

            // Nama hari
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const dayName = days[date.getDay()];

            // Tanggal
            const day = date.getDate();

            // Nama bulan
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            const monthName = months[date.getMonth()];

            // Tahun
            const year = date.getFullYear();

            // Jam, menit, dan detik
            let hours = date.getHours();
            let minutes = date.getMinutes();
            let seconds = date.getSeconds();

            // Tambahkan nol di depan angka yang kurang dari 10
            hours = hours < 10 ? '0' + hours : hours;
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;

            // Format waktu
            const time = hours + ':' + minutes + ':' + seconds;

            // Gabungkan semuanya
            const dateTimeString = dayName + ', ' + day + ' ' + monthName + ' ' + year + ' <br> ' + time;

            // Tampilkan di elemen HTML
            document.getElementById('datetime').innerHTML = dateTimeString;
        }

        // Panggil fungsi untuk memperbarui waktu setiap detik
        setInterval(updateDateTime, 1000);
    
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
      // FUNCTION UNTUK MENAMPILKAN KONTEN SEKETIKA LOADING SELESAIII
        function loadData() {
            // Simulasi loading data (ganti dengan logika pemuatan yang sebenarnya)
            setTimeout(() => {
                // Sembunyikan loading screen
                document.getElementById('loading-screen').style.display = 'none';
            }, 1500); 
        }

        // Panggil function loadData saat halaman dimuat
        window.onload = loadData;
    </script>

</body>
</html>