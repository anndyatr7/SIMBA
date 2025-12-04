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

// Ambil data anak (pastikan anak ini milik user yang login)
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

// Data untuk grafik (ambil 5 data terakhir)
$grafik_query = "SELECT tinggi_badan, berat_badan FROM riwayat_pemeriksaan_anak WHERE id_anak = $id_anak ORDER BY tanggal_periksa DESC LIMIT 5";
$grafik_result = mysqli_query($koneksi, $grafik_query);
$data_grafik = [];
while($row = mysqli_fetch_assoc($grafik_result)){
    $data_grafik[] = $row;
}
$data_grafik = array_reverse($data_grafik); // Reverse agar urutan kronologis
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
// Data dari PHP
const dataGrafik = <?= json_encode($data_grafik) ?>;

// Siapkan data untuk Chart.js
const tinggiData = dataGrafik.map(d => parseFloat(d.tinggi_badan));
const beratData = dataGrafik.map(d => parseFloat(d.berat_badan));
const labels = dataGrafik.map((d, i) => 'Periksa ' + (i + 1));

// DATA WHO — contoh dataset (sesuaikan dengan standar WHO)
const length = [45, 50, 55, 60, 65, 70, 75, 80, 85, 90];
const z3  = [4.2, 6.5, 8.4, 10.2, 12.3, 14.2, 16.4, 18.8, 21.5, 24.2];
const z2  = [3.9, 5.9, 7.6, 9.3, 11.1, 12.9, 15.0, 17.3, 19.9, 22.5];
const z1  = [3.5, 5.3, 6.8, 8.3, 9.9, 11.5, 13.4, 15.5, 17.8, 20.0];
const z0  = [3.2, 4.8, 6.2, 7.6, 9.0, 10.4, 12.1, 14.0, 16.0, 18.1];
const z_1 = [2.9, 4.4, 5.6, 6.9, 8.1, 9.4, 11.0, 12.7, 14.5, 16.3];
const z_2 = [2.7, 4.1, 5.2, 6.3, 7.4, 8.6, 10.1, 11.6, 13.3, 15.0];
const z_3 = [2.5, 3.8, 4.8, 5.8, 6.8, 7.9, 9.3, 10.8, 12.3, 13.8];

// Buat dataset untuk titik anak
const anakDataPoints = dataGrafik.map(d => ({
    x: parseFloat(d.tinggi_badan),
    y: parseFloat(d.berat_badan)
}));

new Chart(document.getElementById("whoChart"), {
    type: "line",
    data: {
        labels: length,
        datasets: [
            { label: "+3 SD", data: z3, borderColor: "#000", tension: 0.4, pointRadius: 0 },
            { label: "+2 SD", data: z2, borderColor: "#ff3b3b", tension: 0.4, pointRadius: 0 },
            { label: "+1 SD", data: z1, borderColor: "#ff8a00", tension: 0.4, pointRadius: 0 },
            { label: "Median", data: z0, borderColor: "#00b050", tension: 0.4, pointRadius: 0 },
            { label: "-1 SD", data: z_1, borderColor: "#ff8a00", tension: 0.4, pointRadius: 0 },
            { label: "-2 SD", data: z_2, borderColor: "#ff3b3b", tension: 0.4, pointRadius: 0 },
            { label: "-3 SD", data: z_3, borderColor: "#000", tension: 0.4, pointRadius: 0 },
            {
                label: "<?= $anak['nama_anak'] ?>",
                data: anakDataPoints,
                pointRadius: 6,
                pointBackgroundColor: "#0066ff",
                showLine: true,
                borderColor: "#0066ff",
                borderWidth: 2,
                tension: 0.3
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: true, position: 'bottom' }
        },
        scales: {
            x: { title: { display: true, text: "Tinggi (cm)" } },
            y: { title: { display: true, text: "Berat (kg)" } }
        }
    }
});
</script>

</body>
</html>