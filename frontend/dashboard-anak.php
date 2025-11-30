<?php
session_start();
require "../backend/koneksi.php";

// Cek apakah user sudah login
if(!isset($_SESSION['id_user'])){
    header("location: login.php");
    exit;
}

$id_user = $_SESSION['id_user']; // ID ibu yang login

// Ambil ID anak dari URL
if(!isset($_GET['id'])){
    echo "<script>
            alert('ID anak tidak ditemukan!');
            window.location.href = 'dashboard-ibu.php';
          </script>";
    exit;
}

$id_anak = (int)$_GET['id'];

// Ambil data anak DAN pastikan anak ini milik ibu yang login (PENTING untuk keamanan!)
$anak_query = "SELECT * FROM data_anak WHERE id_anak = ? AND id_user = ?";
$anak_stmt = mysqli_prepare($koneksi, $anak_query);
mysqli_stmt_bind_param($anak_stmt, "ii", $id_anak, $id_user);
mysqli_stmt_execute($anak_stmt);
$anak_result = mysqli_stmt_get_result($anak_stmt);

// Cek apakah data anak ditemukan
if(mysqli_num_rows($anak_result) == 0){
    echo "<script>
            alert('Data anak tidak ditemukan atau bukan milik Anda!');
            window.location.href = 'dashboard-ibu.php';
          </script>";
    exit;
}

$anak = mysqli_fetch_assoc($anak_result);

// Ambil data ibu
$user_query = "SELECT * FROM user WHERE id_user = ?";
$user_stmt = mysqli_prepare($koneksi, $user_query);
mysqli_stmt_bind_param($user_stmt, "i", $id_user);
mysqli_stmt_execute($user_stmt);
$user_result = mysqli_stmt_get_result($user_stmt);
$user = mysqli_fetch_assoc($user_result);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Anak</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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

        <a href="dashboard-ibu.php"class="switch-btn">
            Beralih ke Layanan Ibu
        </a>
    </div>

    <div class="right">
        <div class="profile">
            <div class="name">nama</div>
            <div class="email">email</div>
        </div>

        <button class="logout-btn">
            Keluar
        </button>
    </div>
</div>

<br><br>

<!-- NAVIGATION -->
<div class="custom-nav">
    <a href="dashboard-anak.php" class="nav-item active"><i class="fa-solid fa-house"></i> Dashboard</a>
    <a href="riwayat-anak.php" class="nav-item"><i class="fa-regular fa-file-lines"></i> Riwayat</a>
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
        <h4 class="section-title">Grafik Berat Badan dan Tinggi Badan</h4>
        <canvas id="whoChart" style="height:250px;"></canvas>
    </div>

    <!-- Usia Anak -->
    <div class="info-card age-card">
        <div class="info-icon"><i class="fa-regular fa-calendar"></i></div>
        <div class="info-label">Usia Anak</div>
        <div class="info-value">2 Tahun</div>
    </div>

        <!-- Lingkar Kepala -->
    <div class="info-card head-card">
        <div class="info-icon"><i class="fa-solid fa-brain"></i></div>
        <div class="info-label">Lingkar Kepala</div>
        <div class="info-value">45 cm</div>
    </div>

    <!-- Lingkar Lengan -->
    <div class="info-card arm-card">
        <div class="info-icon"><i class="fa-solid fa-hand-fist"></i></div>
        <div class="info-label">Lingkar Lengan</div>
        <div class="info-value">14 cm</div>
    </div>

    <!-- PESAN DOKTER -->
    <div class="doctor-card">
        <div class="doctor-icon">
            <i class="fa-solid fa-stethoscope"></i>
        </div>

        <div class="doctor-content">
            <h5 class="doctor-title">Pesan Dokter</h5>
            <p class="doctor-name">Dr. Nathania</p>
            <p class="doctor-text">
            Pastikan anak cukup tidur dan tetap penuhi kebutuhan nutrisi harian.
            Lakukan pemeriksaan rutin untuk memantau tumbuh kembang.
            </p>
        </div>
    </div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// nilai dari input user (PHP → JS)
const anakLength = <?php echo json_encode($_POST['tinggi'] ?? null); ?>;
const anakWeight = <?php echo json_encode($_POST['berat'] ?? null); ?>;

// DATA WHO — contoh dataset
const length = [45,50,55,60,65,70,75,80,85,90];
const z3  = [4.2,6.5,8.4,10.2,12.3,14.2,16.4,18.8,21.5,24.2];
const z2  = [3.9,5.9,7.6,9.3,11.1,12.9,15.0,17.3,19.9,22.5];
const z1  = [3.5,5.3,6.8,8.3,9.9,11.5,13.4,15.5,17.8,20.0];
const z0  = [3.2,4.8,6.2,7.6,9.0,10.4,12.1,14.0,16.0,18.1];
const z_1 = [2.9,4.4,5.6,6.9,8.1,9.4,11.0,12.7,14.5,16.3];
const z_2 = [2.7,4.1,5.2,6.3,7.4,8.6,10.1,11.6,13.3,15.0];
const z_3 = [2.5,3.8,4.8,5.8,6.8,7.9,9.3,10.8,12.3,13.8];

new Chart(document.getElementById("whoChart"), {
    type: "line",
    data: {
        labels: length,
        datasets: [
            { label:"+3 SD", data:z3, borderColor:"#000", tension:0.4 },
            { label:"+2 SD", data:z2, borderColor:"#ff3b3b", tension:0.4 },
            { label:"+1 SD", data:z1, borderColor:"#ff8a00", tension:0.4 },
            { label:"Median", data:z0, borderColor:"#00b050", tension:0.4 },
            { label:"-1 SD", data:z_1, borderColor:"#ff8a00", tension:0.4 },
            { label:"-2 SD", data:z_2, borderColor:"#ff3b3b", tension:0.4 },
            { label:"-3 SD", data:z_3, borderColor:"#000", tension:0.4 },

            // titik anak
            {
                label: "Anak",
                data: anakLength && anakWeight ? [{x: anakLength, y: anakWeight}] : [],
                pointRadius: 8,
                pointBackgroundColor: "#0066ff",
                showLine: false
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
        legend: { display: false } 
        },
        scales: {
            x: { title:{display:true, text:"Tinggi (cm)"} },
            y: { title:{display:true, text:"Berat (kg)"} }
        }
    }
});
</script>

</body>
</html>
