<?php 
require "../backend/koneksi.php";

if(!isset($_GET['id_anak'])){
    header("location: admin-dashboard-anak.php");
    exit;
}

$id_anak = $_GET['id_anak'];

// Ambil data anak
$query = "SELECT da.*, u.nama_user as nama_ibu 
          FROM data_anak da 
          JOIN user u ON da.id_user = u.id_user 
          WHERE da.id_anak='$id_anak'";
$result = mysqli_query($koneksi, $query);
$data_anak = mysqli_fetch_assoc($result);

if(!$data_anak){
    echo "<script>
            alert('Data anak tidak ditemukan!');
            window.location.href = 'admin-dashboard-anak.php';
          </script>";
    exit;
}

// Hitung usia anak dalam bulan
$tanggal_lahir = new DateTime($data_anak['tanggal_lahir']);
$sekarang = new DateTime();
$interval = $tanggal_lahir->diff($sekarang);
$usia_bulan = ($interval->y * 12) + $interval->m;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Tambah Riwayat Anak</title>
    <style>
        body{
            margin-top: 90px;
        }
        .card-header {
            padding: 0 !important;
        }
        .card{
            min-height: 90vh;
            background: rgba(231, 247, 252, 1);
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
            <a href="admin-riwayat-anak.php?id_anak=<?= $id_anak ?>">Kembali</a>
        </div>
    </nav>
    <!-- NavBar End -->

    <div class="container mt-4 mb-4">
        <div class="card text-center mx-auto shadow rounded" style="width: 100%">
            <div class="card-header p-0">
                <ul class="nav nav-tabs w-100 d-flex justify-content-center">
                    <li class="nav-item flex-fill text-center">
                        <a style="background: white;" class="nav-link" href="admin-riwayat-anak.php?id_anak=<?= $id_anak ?>">Riwayat Pemeriksaan</a>
                    </li>
                    <li class="nav-item flex-fill text-center">
                        <a class="nav-link active" href="admin-tambah-anak.php?id_anak=<?= $id_anak ?>">Tambah Riwayat Pemeriksaan</a>
                    </li>
                </ul>
            </div>
            
            <div class="card-body p-4">
                <div class="mb-4 text-start">
                    <h5>Data Anak: <?= $data_anak['nama_anak'] ?></h5>
                    <p class="mb-0">Ibu: <?= $data_anak['nama_ibu'] ?> | Tanggal Lahir: <?= date('d F Y', strtotime($data_anak['tanggal_lahir'])) ?></p>
                </div>

                <form action="../backend/tambah-riwayat-anak.php" method="POST">
                    
                    <input type="hidden" name="id_anak" value="<?= $id_anak ?>">

                    <!-- ROW 1 -->
                    <div class="row g-4">
                        <div class="col-3">
                            <label for="usia_bulan">Usia (bulan)</label>
                            <input type="number" class="form-control" name="usia_bulan" value="<?= $usia_bulan ?>" readonly>
                        </div>
                        <div class="col-3">
                            <label for="bb">Berat Badan (kg)</label>
                            <input type="number" step="0.01" class="form-control" placeholder="10.5" name="bb" required>
                        </div>
                        <div class="col-3">
                            <label for="tb">Tinggi Badan (cm)</label>
                            <input type="number" step="0.01" class="form-control" placeholder="75.5" name="tb" required>
                        </div>
                        <div class="col-3">
                            <label for="lingkar_kepala">Lingkar Kepala (cm)</label>
                            <input type="number" step="0.01" class="form-control" placeholder="45" name="lingkar_kepala">
                        </div>
                    </div>

                    <!-- ROW 2 -->
                    <div class="row g-4 mt-1">
                        <div class="col-3">
                            <label for="lingkar_lengan">Lingkar Lengan (cm)</label>
                            <input type="number" step="0.01" class="form-control" placeholder="14" name="lingkar_lengan">
                        </div>
                        <div class="col-3">
                            <label for="status_gizi">Status Gizi</label>
                            <select class="form-control" name="status_gizi" required>
                                <option value="">Pilih Status</option>
                                <option value="Gizi Baik">Gizi Baik</option>
                                <option value="Gizi Kurang">Gizi Kurang</option>
                                <option value="Gizi Buruk">Gizi Buruk</option>
                                <option value="Gizi Lebih">Gizi Lebih</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="vitamin">Vitamin yang Diberikan</label>
                            <input type="text" class="form-control" placeholder="Vitamin A" name="vitamin">
                        </div>
                        <div class="col-3">
                            <label for="imunisasi">Imunisasi</label>
                            <div class="dropdown">
                                <button class="btn btn-light w-100 border dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Pilih Imunisasi
                                </button>
                                <ul class="dropdown-menu w-100 p-2">
                                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 imunCheck" value="BCG"> BCG</label></li>
                                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 imunCheck" value="Hepatitis B"> Hepatitis B</label></li>
                                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 imunCheck" value="Polio"> Polio</label></li>
                                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 imunCheck" value="DPT"> DPT</label></li>
                                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 imunCheck" value="Campak"> Campak</label></li>
                                </ul>
                            </div>
                            <input type="hidden" name="imunisasi" id="imunInput">
                        </div>
                    </div>

                    <!-- ROW 3 -->
                    <div class="row g-4 mt-1">
                        <div class="col-6">
                            <label for="keluhan">Keluhan</label>
                            <textarea class="form-control" name="keluhan" rows="3" placeholder="Keluhan orang tua atau gejala yang terlihat"></textarea>
                        </div>
                        <div class="col-6">
                            <label for="diagnosis">Diagnosis</label>
                            <textarea class="form-control" name="diagnosis" rows="3" placeholder="Diagnosis dokter"></textarea>
                        </div>
                    </div>

                    <!-- ROW 4 -->
                    <div class="mt-4">
                        <label>Catatan Dokter</label>
                        <textarea class="form-control" name="catatan_dokter" rows="3" required></textarea>
                    </div>

                    <button type="submit" name="tambah_riwayat_anak" class="btn btn-primary mt-5" style="width: 50%;">Simpan Data Pemeriksaan</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

    <script>
        // Handle checkbox imunisasi
        document.querySelectorAll(".imunCheck").forEach(cb => {
            cb.addEventListener("change", () => {
                let selected = [];
                document.querySelectorAll(".imunCheck:checked").forEach(x => {
                    selected.push(x.value);
                });
                document.getElementById("imunInput").value = selected.join(", ");
            });
        });
    </script>
</body>
</html>