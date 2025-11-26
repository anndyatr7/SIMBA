<?php
session_start();
require "../backend/koneksi.php";

// Ambil semua user untuk dropdown
$users_query = "SELECT id_user, nama_user, nik FROM user ORDER BY nama_user";
$users_result = mysqli_query($koneksi, $users_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Tambah Riwayat</title>
    <style>
        body{
            margin-top: 90px;
        }
        .card-header {
            padding: 0 !important;
        }
        .card{
            min-height: 90vh;
            background: rgba(255, 235, 244, 1);
        }

        .nav-tabs .nav-link.active {
            color: #000 !important;        
            font-weight: 700 !important;
        }

        .nav-tabs .nav-link {
            color: rgba(0, 0, 0, 0.5) !important;
            font-weight: 500;
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
                <a href="#" class="simba">SIMBA</a>
                <p>Sistem Informasi Ibu dan Anak</p>
            </div>
        </div>

        <div class="nav-right">
            <a href="admin-dashboard-ibu.php">Dashboard</a>
            <a href="../backend/logout.php">Logout</a>
        </div>
    </nav>
    <!-- NavBar End -->

    <div class="container mt-4 mb-4">
        <div class="card text-center mx-auto shadow rounded" style="width: 100%">
            <div class="card-header p-0">
                <ul class="nav nav-tabs w-100 d-flex justify-content-center">
                    <li class="nav-item flex-fill text-center">
                        <a style="background: white;" class="nav-link" href="admin-riwayat.php">Riwayat Pemeriksaan</a>
                    </li>
                    <li class="nav-item flex-fill text-center">
                        <a class="nav-link active" href="admin-tambah.php">Tambah Riwayat Pemeriksaan</a>
                    </li>
                </ul>
            </div>
            <div class="card-body p-4">
                <form action="../backend/tambah-riwayat.php" method="POST">

                    <!-- Pilih User -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <label for="id_user">Pilih Ibu Hamil</label>
                            <select class="form-select" name="id_user" required>
                                <option value="">-- Pilih Ibu Hamil --</option>
                                <?php while($user = mysqli_fetch_assoc($users_result)): ?>
                                    <option value="<?= $user['id_user'] ?>">
                                        <?= $user['nama_user'] ?> (NIK: <?= $user['nik'] ?>)
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>

                    <!-- ROW 1 -->
                    <div class="row g-4">
                        <div class="col-4">
                            <label for="tb">Tinggi Badan</label>
                            <input type="number" step="0.01" class="form-control" placeholder="...cm" name="tb" required>
                        </div>
                        <div class="col-4">
                            <label for="bb">Berat Badan</label>
                            <input type="number" step="0.01" class="form-control" placeholder="...kg" name="bb" required>
                        </div>
                        <div class="col-4">
                            <label for="tenxi">Tekanan Darah</label>
                            <input type="text" class="form-control" placeholder="120/80" name="tenxi" required>
                        </div>
                    </div>

                    <!-- ROW 2 -->
                    <div class="row g-4 mt-1">
                        <div class="col-4">
                            <label for="usiahamil">Usia Kehamilan</label>
                            <input type="number" class="form-control" placeholder="...minggu" name="usiahamil" required>
                        </div>
                        <div class="col-4">
                            <label for="fundus">Tinggi Fundus Uterus</label>
                            <input type="number" step="0.01" class="form-control" placeholder="...cm" name="fundus" required>
                        </div>
                        <div class="col-4">
                            <label for="denyut">Denyut Jantung Bayi</label>
                            <input type="number" class="form-control" placeholder="...kali/menit" name="denyut" required>
                        </div>
                    </div>

                    <!-- ROW 3 -->
                    <div class="row g-4 mt-1">
                        <div class="col-6">
                            <label for="keluhan">Keluhan Ibu Hamil</label>
                            <div class="dropdown">
                                <button class="btn btn-light w-100 border dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Pilih Keluhan
                                </button>
                                 <ul class="dropdown-menu w-100 p-2" id="keluhanMenu">
                                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 keluhanCheck" value="Mual"> Mual</label></li>
                                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 keluhanCheck" value="Pusing"> Pusing</label></li>
                                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 keluhanCheck" value="Kaki Bengkak"> Kaki Bengkak</label></li>
                                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 keluhanCheck" value="Nyeri Pinggang"> Nyeri Pinggang</label></li>
                                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 keluhanCheck" value="Tidak Ada"> Tidak Ada</label></li>
                                </ul>
                            </div>
                            <input type="hidden" name="keluhan" id="keluhanInput">
                        </div>                   
                        <div class="col-3 text-start">
                           <label>Aktivitas Bayi</label>
                            <div class="d-flex align-items-center mb-2">
                                <input class="form-check-input" style="margin-right: 10px;" type="radio" name="aktifitas" id="aktif" value="Aktif" required>
                                <label class="form-check-label" for="aktif">Aktif</label>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <input class="form-check-input" style="margin-right: 10px;" type="radio" name="aktifitas" id="tenang" value="Tenang">
                                <label class="form-check-label" for="tenang">Tenang</label>
                            </div>
                        </div>
                        <div class="col-3 text-start">
                            <label>Tablet TTD Diberikan</label>
                            <div class="d-flex align-items-center mb-2">
                                <input class="form-check-input" style="margin-right: 10px;" type="radio" name="ttd" id="ya" value="Ya" required>
                                <label class="form-check-label" for="ya">Ya</label>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <input class="form-check-input" style="margin-right: 10px;" type="radio" name="ttd" id="tidak" value="Tidak">
                                <label class="form-check-label" for="tidak">Tidak</label>
                            </div>
                        </div>
                    </div>

                    <!-- ROW 5 -->
                    <div class="mt-4">
                        <label>Catatan Dokter</label>
                        <textarea class="form-control" name="alasan" rows="3" required></textarea>
                    </div>

                    <button type="submit" name="tambah_riwayat" class="btn btn-primary mt-5" style="width: 50%;">Tambah</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

    <script>
        document.querySelectorAll(".keluhanCheck").forEach(cb => {
            cb.addEventListener("change", () => {
                let selected = [];
                document.querySelectorAll(".keluhanCheck:checked").forEach(x => {
                    selected.push(x.value);
                });
                document.getElementById("keluhanInput").value = selected.join(", ");
            });
        });
    </script>
</body>
</html>