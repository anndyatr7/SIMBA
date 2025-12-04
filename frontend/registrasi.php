<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        .kotak{
            width: 700px;
            min-height: 500px;
            background: rgb(244, 241, 245);
        }
    </style>
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
            <a href="homepage.php">Home</a>
            <a href="homepage.php #layanan">Layanan</a>
        </div>
    </nav>
    <!-- NavBar End -->

    <div class="d-flex justify-content-center" style="padding: 40px; margin-top: 70px">
        <div class="kotak" style="padding: 30px 45px 45px 45px;">
            <div style="text-align: center;">
                <h2>Formulir Pendaftaran Akun</h2>
                <hr />
            </div>

            <form action="../backend/auth.php" method="POST" novalidate>
                <div class="d-flex gap-4">
                    <div class="form-group w-50">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" placeholder="Masukkan Nama Anda" class="form-control" name="nama" required>
                    </div>
                    <div class="form-group w-50">
                        <label for="nik">NIK</label>
                        <input type="text" placeholder="Masukkan NIK Anda" class="form-control" name="nik" required>
                    </div>
                </div>
                
                <div class="d-flex gap-4 mt-3">
                    <div class="form-group w-50">
                        <label for="email">Alamat Email</label>
                        <input type="email" placeholder="contoh@email.com" class="form-control" name="email" required>
                    </div>
                    <div class="form-group w-50">
                        <label for="password">Password Akun</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                </div>
                
                <div class="d-flex gap-4 mt-3">
                    <div class="form-group w-40">
                        <label for="no_hp">Nomor HP</label>
                        <input type="text" placeholder="08XXXXXXXX" class="form-control" name="no_hp" required>
                    </div>
                    <div class="form-group w-30">
                        <label for="goldar">Golongan Darah</label>
                        <div class="dropdown">
                            <button class="btn btn-light w-100 border dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <span id="goldarDisplay">Pilih Golongan Darah</span>
                            </button>
                            <ul class="dropdown-menu w-100 p-2">
                                <li><label class="dropdown-item"><input type="radio" class="me-2 goldarCheck" name="goldar_radio" value="A"> A</label></li>
                                <li><label class="dropdown-item"><input type="radio" class="me-2 goldarCheck" name="goldar_radio" value="B"> B</label></li>
                                <li><label class="dropdown-item"><input type="radio" class="me-2 goldarCheck" name="goldar_radio" value="AB"> AB</label></li>
                                <li><label class="dropdown-item"><input type="radio" class="me-2 goldarCheck" name="goldar_radio" value="O"> O</label></li>
                            </ul>
                        </div>
                        <!-- Hidden input untuk mengirim ke backend -->
                        <input type="hidden" name="goldar" id="goldarInput" required>
                    </div> 
                    <div class="form-group w-30 text-start">
                        <label>Gender</label>
                         <div class="d-flex align-items-center mb-2">
                             <input class="form-check-input" style="margin-right: 10px;" type="radio" name="gender" id="Perempuan" value="Perempuan" required>
                             <label class="form-check-label" for="Perempuan">Perempuan</label>
                         </div>
                         <div class="d-flex align-items-center mb-2">
                             <input class="form-check-input" style="margin-right: 10px;" type="radio" name="gender" id="Laki-laki" value="Laki-laki">
                             <label class="form-check-label" for="Laki-laki">Laki-laki</label>
                         </div>
                    </div>
                </div>

                <div class="row g-4 mt-1">
                    <div class="col-5">
                        <div class="mb-3">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" placeholder="Kota Kelahiran" name="tempat_lahir" id="tempat_lahir" required>
                        </div>
                        <div>
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" required>
                        </div>
                    </div>
                    
                    <div class="col-7">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="5" placeholder="Masukkan alamat lengkap" required></textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-2 mt-3">
                    <button type="submit" class="btn btn-primary mt-3" style="width: 75%;" name="regis">Daftar Sekarang</button>
                    <button type="reset" class="btn btn-danger mt-3" style="width: 25%;">Reset</button>
                </div>
                
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    
    <script>
        // Handle dropdown golongan darah
        document.querySelectorAll(".goldarCheck").forEach(radio => {
            radio.addEventListener("change", (e) => {
                const value = e.target.value;
                document.getElementById("goldarDisplay").textContent = value;
                document.getElementById("goldarInput").value = value;
            });
        });
    </script>
</body>
</html>