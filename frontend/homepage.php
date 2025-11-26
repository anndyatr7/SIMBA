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
                <a href="homepage.php" class="simba">SIMBA</a>
                <p>Sistem Informasi Ibu dan Anak</p>
            </div>
        </div>

        <div class="nav-right">
            <a href="#home">Home</a>
            <a href="#layanan">Layanan</a>
        </div>
    </nav>
    <!-- NavBar End -->

    <!-- Hero Section -->
     <section class="hero" id="home">
        <h1>Selamat Datang di SIMBA!</h1>
        <main class="content">
            <img src="../img/klara-kulikova-o1rq5GwVorY-unsplash.jpg" alt="ini foto" class="photo">
            <div class="deskripsi">
                <h3>Layanan Kesehatan Ibu dan Anak</h3>
                <p>SIMBA menyediakan layanan pemeriksaan kesehatan untuk ibu hamil dan anak-anak dengan tenaga kesehatan profesional.</p>
                <div class="deskripsi-poin">
                    <h3>✔ Tenaga Profesional</h3>
                    <p>Didukung oleh bidan dan perawan berpengalaman</p>
                </div>
                <div class="deskripsi-poin">
                    <h3>✔ Gratis untuk Semua</h3>
                    <p>Tidak ada biaya untuk pemeriksaan rutin</p>
                </div>
            </div>
        </main>
     </section>
     <!-- Hero Section End -->

    <!-- Layanan Section -->
     <section class="layanan" id="layanan">
        <h2>Pilih Layanan</h2>
        <p class="keterangan-layanan">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatum quaerat repellat totam. Laborum, voluptate accusantium.</p>
        <div class="pilih-layanan">
            <div class="ibu" id="openModalIbu">
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
            <div class="anak" id="openModalAnak">
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
        <div class="button-login-admin" id="openModalAdmin">
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


    <!-- Modal Login Ibu -->
    <div id="modalIbu" class="modal-overlay">
        <form action="../backend/auth.php" method="POST">
            <div class="modal-box">
                <h2>Login ke Layanan Ibu</h2>
                <label>NIK</label>
                <input type="text" placeholder="Masukkan NIK" name="NIK">
                <label >Password</label>
                <input type="password" placeholder="Masukkan Password" name="password">
                <button class="login-submit" name="login">Login</button>

                <p class="register">Belum Punya akun? <a href="registrasi.php">Registrasi di sini</a></p>
            </div>
        </form>
    </div>

    <!-- Modal Login Anak -->
    <div id="modalAnak" class="modal-overlay">
        <form action="../backend/auth.php" method="POST">
            <div class="modal-box">
                <h2>Login ke Layanan Anak</h2>
                <label>NIK</label>
                <input type="text" placeholder="Masukkan NIK" name="NIK">
                <label >Password</label>
                <input type="password" placeholder="Masukkan Password" name="password">
                <button class="login-submit" name="login">Login</button>

                <p class="register">Belum Punya akun? <a href="registrasi.php">Registrasi di sini</a></p>
            </div>
        </form>
    </div>

    <!-- Modal Login Admin -->
    <div id="modalAdmin" class="modal-overlay">
        <form action="../backend/auth.php" method="POST">
            <div class="modal-box">
                <h2>Login Admin</h2>
                <label>NIP</label>
                <input type="text" placeholder="Masukkan NIP" name="NIP">
                <label >Password</label>
                <input type="password" placeholder="Masukkan Password" name="passwordAdmin">
                <button class="login-submit" name="loginAdmin">Login</button>
            </div>
        </form>
    </div>

    <!-- Script gw -->
    <script>
        const modalIbu = document.getElementById("modalIbu");
        const openModalIbu = document.getElementById("openModalIbu");

        //Open Modal
        openModalIbu.addEventListener("click", () =>{
            modalIbu.style.display = "flex";
        })

        //Close Modal
        modalIbu.addEventListener("click", (e) =>{
            if(e.target === modalIbu){
                modalIbu.style.display = "none";
            }
        })

        const modalAnak = document.getElementById("modalAnak");
        const openModalAnak = document.getElementById("openModalAnak");

        openModalAnak.addEventListener("click", () =>{
            modalAnak.style.display = "flex";
        })

        modalAnak.addEventListener("click", (e) =>{
            if(e.target === modalAnak){
                modalAnak.style.display = "none";
            }
        })

        const modalAdmin = document.getElementById("modalAdmin");
        const openModalAdmin = document.getElementById("openModalAdmin");

        openModalAdmin.addEventListener("click", () =>{
            modalAdmin.style.display = "flex";
        })

        modalAdmin.addEventListener("click", (e) =>{
            if(e.target === modalAdmin){
                modalAdmin.style.display = "none"
            }
        })
    </script>

     <!-- Script Bootsrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>


    <!-- Feather Icons -->
    <script>
      feather.replace();
    </script>
</body>
</html>