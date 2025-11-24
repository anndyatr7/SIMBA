<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMBA Sistem Informasi Ibu dan Anak</title>

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">

    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- feather icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- my style -->
    <link rel="stylesheet" href="styling/buatindex.css?v<?php echo time();?>" >
</head>
<body>
    <!-- NavBar Start -->
    <nav class="navbar">
        <div class="nav-left">
            <img src="../img/logo.jpg" alt="ini logo" class="logo">
            <div class="Judul">
                <a href="#" class="simba">SIMBA</a>
                <p>Sistem Informasi Ibu dan Anak</p>
            </div>
        </div>

        <div class="nav-right">
            <a href="#">Home</a>
            <a href="#layanan">Layanan</a>
        </div>
    </nav>
    <!-- NavBar End -->

    <!-- Hero Section -->
     <section class="hero" id="home">
        <h1>Selamat Datang di Simba!</h1>
        <main class="content">
            <img src="../img/klara-kulikova-o1rq5GwVorY-unsplash.jpg" alt="ini foto" class="photo">
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus, distinctio. Eos illum ducimus dolores, est praesentium, inventore, unde sunt quia dolorem provident reprehenderit doloremque sint vitae veniam! Eaque quam at nobis! Obcaecati enim nihil, aperiam impedit sint quos placeat quaerat?</p>
        </main>
     </section>
     <!-- Hero Section End -->

    <!-- Layanan Section -->
     <section class="layanan" id="layanan">
        <h2>Pilih Layanan</h2>
        <p class="keterangan-layanan">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatum quaerat repellat totam. Laborum, voluptate accusantium.</p>
        <div class="pilih-layanan">
            <div class="ibu">
                <div class="logo-ibu">
                    <i data-feather="heart"></i>
                </div>
                 <h3>Layanan Ibu</h3>
                 <p>Pemeriksaan kehamilan serta konseling ibu hamil dan menyusui</p>
                 <div class="point-ibu">
                    <p>● Pemeriksaan Kehamilan</p>
                    <p>● Konseling Gizi</p>
                 </div>
            </div>
            <div class="anak">
                <div class="logo-anak">
                    <i data-feather="activity"></i>
                </div>
                 <h3>Layanan Anak</h3>
                 <p>Imunisasi, pemantauan tumbuh kembang, dan konsultasi kesehatan anak</p>
                 <div class="point-anak">
                    <p>● Pemeriksaan Kehamilan</p>
                    <p>● Konseling Gizi</p>
                 </div>
            </div>
        </div>
        <div class="button-login-admin">
            <h4>Login Sebagai Admin</h4>
       </div>
     </section>
     <!-- Layanan Section End -->

      <!-- FOOTER -->
    <footer>
        <div class="footer-container">

            <div class="footer-box">
                <h4>Posyandu Sehat</h4>
                <p>Melayani kesehatan ibu dan anak dengan sepenuh hati untuk Indonesia yang lebih sehat.</p>
            </div>

            <div class="footer-box">
                <h4>Kontak</h4>
                <p>Jl. Kesehatan No. 123, Jakarta</p>
                <p>Telp: (021) 1234-5678</p>
                <p>Email: info@posyandu-sehat.id</p>
            </div>

            <div class="footer-box">
                <h4>Jam Operasional</h4>
                <p>Senin - Jumat: 08.00 - 16.00</p>
                <p>Sabtu: 08.00 - 12.00</p>
                <p>Minggu: Tutup</p>
            </div>

        </div>

        <p class="copy">© 2025 Posyandu Sehat. All rights reserved.</p>
    </footer>
    <!-- Footer End -->


     <!-- Script Bootsrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>


    <!-- Feather Icons -->
    <script>
      feather.replace();
    </script>
</body>
</html>