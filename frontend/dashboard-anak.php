<?php
session_start();
require "../backend/koneksi.php";

// Cek apakah user sudah login dan ada id_anak
if(!isset($_SESSION['id_user']) || !isset($_GET['id_anak'])){
    header("location: homepage.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$id_anak = $_GET['id_anak'];

// Ambil data user
$user_query = "SELECT * FROM user WHERE id_user = $id_user";
$user_result = mysqli_query($koneksi, $user_query);
$user = mysqli_fetch_assoc($user_result);

// Ambil data anak
$anak_query = "SELECT * FROM data_anak WHERE id_anak = $id_anak AND id_user = $id_user";
$anak_result = mysqli_query($koneksi, $anak_query);
$anak = mysqli_fetch_assoc($anak_result);

if(!$anak){
    echo "<script>
            alert('Data anak tidak ditemukan!');
            window.location.href = 'dashboard-ibu.php';
          </script>";
    exit;
}

// Hitung usia anak
$tanggal_lahir = new DateTime($anak['tanggal_lahir']);
$sekarang = new DateTime();
$usia = $sekarang->diff($tanggal_lahir);
$usia_tahun = $usia->y;
$usia_bulan = $usia->m;
$usia_text = $usia_tahun > 0 ? $usia_tahun . " Tahun " . $usia_bulan . " Bulan" : $usia_bulan . " Bulan";

// Ambil riwayat pemeriksaan terakhir
$riwayat_query = "SELECT * FROM riwayat_pemeriksaan_anak WHERE id_anak = $id_anak ORDER BY tanggal_periksa DESC LIMIT 1";
$riwayat_result = mysqli_query($koneksi, $riwayat_query);
$riwayat_terakhir = mysqli_fetch_assoc($riwayat_result);


?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Anak - <?= $anak['nama_anak'] ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="styling/styleanak.css?v<?php echo time();?>">
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="left">
        <div class="logo">
            <i class="fa-solid fa-baby"></i>
        </div>

        <div class="text">
            <div class="title">Layanan Anak</div>
            <div class="subtitle">Posyandu Sehat</div>
        </div>

        <a href="dashboard-ibu.php" class="switch-btn">
            Beralih ke Layanan Ibu
        </a>
    </div>

    <div class="right">
        <div class="profile">
            <div class="name"><?= $user['nama_user'] ?></div>
            <div class="email"><?= $user['email'] ?></div>
        </div>

        <a href="../backend/logout.php" class="logout-btn" style="text-decoration: none; color: inherit;">
            Keluar
        </a>
    </div>
</div>

<br><br>

<!-- NAVIGATION -->
<div class="custom-nav">
    <a href="dashboard-anak.php?id_anak=<?= $id_anak ?>" class="nav-item active"><i class="fa-solid fa-house"></i> Dashboard</a>
    <a href="riwayat-anak.php?id_anak=<?= $id_anak ?>" class="nav-item"><i class="fa-regular fa-file-lines"></i> Riwayat</a>
</div>

<!-- WELCOME -->
<div class="welcome-banner">
    <h4>Haloo, <?= $anak['nama_anak'] ?>!</h4>
    <p>Pantau tumbuh kembang anak Anda dan kelola imunisasi dengan mudah</p>
</div>

<!-- GRID LAYOUT -->
<div class="main-grid">

    <!-- Grafik -->
    <div class="growth-card">
        <h4 class="section-title">Grafik Pertumbuhan <?= $anak['nama_anak'] ?></h4>
        <canvas id="whoChart" style="height:250px;"></canvas>
    </div>

    <!-- Usia Anak -->
    <div class="info-card age-card">
        <div class="info-icon"><i class="fa-regular fa-calendar"></i></div>
        <div class="info-label">Usia Anak</div>
        <div class="info-value"><?= $usia_text ?></div>
    </div>

    <!-- Lingkar Kepala -->
    <div class="info-card head-card">
        <div class="info-icon"><i class="fa-solid fa-brain"></i></div>
        <div class="info-label">Lingkar Kepala</div>
        <div class="info-value"><?= $riwayat_terakhir ? $riwayat_terakhir['lingkar_kepala'] . ' cm' : '-' ?></div>
    </div>

    <!-- Lingkar Lengan -->
    <div class="info-card arm-card">
        <div class="info-icon"><i class="fa-solid fa-hand-fist"></i></div>
        <div class="info-label">Lingkar Lengan</div>
        <div class="info-value"><?= $riwayat_terakhir ? $riwayat_terakhir['lingkar_lengan'] . ' cm' : '-' ?></div>
    </div>

    <!-- PESAN DOKTER -->
    <?php if($riwayat_terakhir && $riwayat_terakhir['catatan_dokter']): ?>
    <div class="doctor-card">
        <div class="doctor-icon">
            <i class="fa-solid fa-stethoscope"></i>
        </div>

        <div class="doctor-content">
            <h5 class="doctor-title">Catatan Terakhir</h5>
            <p class="doctor-name">Tanggal: <?= date('d F Y', strtotime($riwayat_terakhir['tanggal_periksa'])) ?></p>
            <p class="doctor-text"><?= $riwayat_terakhir['catatan_dokter'] ?></p>
        </div>
    </div>
    <?php else: ?>
    <div class="doctor-card">
        <div class="doctor-icon">
            <i class="fa-solid fa-info-circle"></i>
        </div>
        <div class="doctor-content">
            <h5 class="doctor-title">Informasi</h5>
            <p class="doctor-text">Belum ada riwayat pemeriksaan. Silakan kunjungi posyandu untuk pemeriksaan pertama.</p>
        </div>
    </div>
    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// DATA DUMMY
const dataGrafik = [
    { usia: 1, tinggi_badan: 50 },
    { usia: 2, tinggi_badan: 55 },
    { usia: 3, tinggi_badan: 60 },
    { usia: 4, tinggi_badan: 65 },
    { usia: 5, tinggi_badan: 70 }
];

const anakDataPoints = dataGrafik.map(d => ({
    x: d.usia,
    y: d.tinggi_badan
}));

new Chart(document.getElementById("whoChart"), {
    type: "line",
    data: {
        datasets: [
            {
                label: "Tinggi Badan Anak",
                data: anakDataPoints,
                borderColor: "#0066ff",
                pointRadius: 6,
                tension: 0.3
            }
        ]
    },
    options: {
        scales: {
            x: { title: { display: true, text: "Usia (bulan)" } },
            y: { title: { display: true, text: "Tinggi Badan (cm)" } }
        }
    }
});
</script>

</body>
</html>