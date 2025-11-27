<?php 
require "../backend/koneksi.php";

// Ambil id_user dari URL
if(!isset($_GET['id_user'])){
    header("location: admin-dashboard-ibu.php");
    exit;
}

$id_user = $_GET['id_user'];

// Ambil data ibu
$queryi = "SELECT * FROM user WHERE id_user='$id_user'";
$ibu = mysqli_query($koneksi, $queryi);
$data_ibu = mysqli_fetch_assoc($ibu);

if(!$data_ibu){
    echo "<script>
            alert('Data ibu tidak ditemukan!');
            window.location.href = 'admin-dashboard-ibu.php';
          </script>";
    exit;
}
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
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 30px;
            margin-bottom: 25px;
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
            <a href="admin-riwayat.php?id_user=<?= $id_user ?>">Kembali</a>
        </div>
    </nav>
    <!-- NavBar End -->

    <div class="container mt-4 mb-4">
        <div class="card text-center mx-auto shadow rounded" style="width: 100%">
            <div class="card-header p-0">
                <ul class="nav nav-tabs w-100 d-flex justify-content-center">
                    <li class="nav-item flex-fill text-center">
                        <a style="background: white;" class="nav-link" href="admin-riwayat.php?id_user=<?= $id_user ?>">Riwayat Pemeriksaan</a>
                    </li>
                    <li class="nav-item flex-fill text-center">
                        <a class="nav-link active" href="admin-tambah.php?id_user=<?= $id_user ?>">Tambah Riwayat Pemeriksaan</a>
                    </li>
                </ul>
            </div>
            
            <div class="card-body p-4">
                <div class="mb-4 text-start">
                    <h5>Data Ibu: <?= $data_ibu['nama_user'] ?></h5>
                    <p class="mb-0">NIK: <?= $data_ibu['nik'] ?></p>
                </div>

                <!-- PERBAIKAN: action ke backend, method POST, tambahkan id_user -->
                <form action="../backend/tambah-riwayat.php" method="POST">
                    
                    <!-- Hidden input untuk id_user -->
                    <input type="hidden" name="id_user" value="<?= $id_user ?>">

                    <!-- ROW 1 -->
                    <div class="row g-4">
                        <div class="col-4">
                            <label for="tb">Tinggi Badan</label>
                            <input type="text" class="form-control" placeholder="...cm" name="tb" required>
                        </div>
                        <div class="col-4">
                            <label for="bb">Berat Badan</label>
                            <input type="text" class="form-control" placeholder="...kg" name="bb" required>
                        </div>
                        <div class="col-4">
                            <label for="tenxi">Tekanan Darah</label>
                            <input type="text" class="form-control" placeholder="120/80" name="tenxi" required>
                        </div>
                    </div>

                    <!-- ROW 2 -->
                    <div class="row g-4 mt-1">
                        <div class="col-4">
                            <label for="usiahamil">Usia Kehamilan (minggu)</label>
                            <input type="number" class="form-control" placeholder="contoh: 12" name="usiahamil" required>
                        </div>
                        <div class="col-4">
                            <label for="fundus">Tinggi Fundus Uterus</label>
                            <input type="text" class="form-control" placeholder="...cm" name="fundus" required>
                        </div>
                        <div class="col-4">
                            <label for="denyut">Denyut Jantung Bayi</label>
                            <input type="text" class="form-control" placeholder="...kali/menit" name="denyut" required>
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
                            <input type="hidden" name="keluhan" id="keluhanInput" required>
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

                    <!-- ROW 4 - Catatan Dokter -->
                    <div class="mt-4">
                        <label>Catatan Dokter</label>
                        <textarea class="form-control" name="alasan" rows="3" required></textarea>
                    </div>

                    <!-- PERBAIKAN: Ganti <a> dengan <button type="submit"> -->
                    <button type="submit" name="tambah_riwayat" class="btn btn-primary mt-5" style="width: 50%;">Simpan Data Pemeriksaan</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

    <script>
        // Handle checkbox keluhan
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