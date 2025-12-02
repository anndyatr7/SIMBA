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

// Ambil semua riwayat pemeriksaan
$riwayat_query = "SELECT * FROM riwayat_pemeriksaan_anak WHERE id_anak = $id_anak ORDER BY tanggal_periksa DESC";
$riwayat_result = mysqli_query($koneksi, $riwayat_query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pemeriksaan - <?= $anak['nama_anak'] ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="styling/styleanak.css?v<?php echo time();?>">
    <style>
        .timeline-card {
            border-left: 3px solid #1e5bf7;
            margin-bottom: 20px;
            transition: all 0.3s;
        }
        
        .timeline-card:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
    </style>
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
    <a href="dashboard-anak.php?id_anak=<?= $id_anak ?>" class="nav-item"><i class="fa-solid fa-house"></i> Dashboard</a>
    <a href="riwayat-anak.php?id_anak=<?= $id_anak ?>" class="nav-item active"><i class="fa-regular fa-file-lines"></i> Riwayat</a>
</div>

<br>

<div class="container mt-4 mb-5">
    <h3 class="mb-4">📋 Riwayat Pemeriksaan <?= $anak['nama_anak'] ?></h3>
    
    <?php if(mysqli_num_rows($riwayat_result) > 0): ?>
        <?php while($riwayat = mysqli_fetch_assoc($riwayat_result)): ?>
        <div class="card timeline-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="card-title mb-0">
                        <i class="fa-regular fa-calendar text-primary"></i> 
                        <?= date('d F Y', strtotime($riwayat['tanggal_periksa'])) ?>
                    </h5>
                    <span class="badge bg-info">Usia: <?= $riwayat['usia_bulan'] ?> bulan</span>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3">Data Pengukuran</h6>
                        
                        <div class="detail-row">
                            <span><i class="fa-solid fa-weight-scale text-warning"></i> Berat Badan</span>
                            <strong><?= $riwayat['berat_badan'] ?> kg</strong>
                        </div>
                        
                        <div class="detail-row">
                            <span><i class="fa-solid fa-ruler-vertical text-success"></i> Tinggi Badan</span>
                            <strong><?= $riwayat['tinggi_badan'] ?> cm</strong>
                        </div>
                        
                        <div class="detail-row">
                            <span><i class="fa-solid fa-brain text-danger"></i> Lingkar Kepala</span>
                            <strong><?= $riwayat['lingkar_kepala'] ?> cm</strong>
                        </div>
                        
                        <div class="detail-row">
                            <span><i class="fa-solid fa-hand-fist text-primary"></i> Lingkar Lengan</span>
                            <strong><?= $riwayat['lingkar_lengan'] ?> cm</strong>
                        </div>
                        
                        <div class="detail-row">
                            <span><i class="fa-solid fa-heart text-danger"></i> Status Gizi</span>
                            <strong><?= $riwayat['status_gizi'] ?></strong>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3">Imunisasi & Catatan</h6>
                        
                        <?php if($riwayat['imunisasi']): ?>
                        <div class="mb-3">
                            <small class="text-muted">Imunisasi:</small><br>
                            <span class="badge bg-success"><?= $riwayat['imunisasi'] ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if($riwayat['vitamin']): ?>
                        <div class="mb-3">
                            <small class="text-muted">Vitamin:</small><br>
                            <span class="badge bg-warning text-dark"><?= $riwayat['vitamin'] ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if($riwayat['keluhan']): ?>
                        <div class="mb-3">
                            <small class="text-muted">Keluhan:</small><br>
                            <p class="mb-0"><?= $riwayat['keluhan'] ?></p>
                        </div>
                        <?php endif; ?>
                        
                        <?php if($riwayat['diagnosis']): ?>
                        <div class="mb-3">
                            <small class="text-muted">Diagnosis:</small><br>
                            <p class="mb-0"><?= $riwayat['diagnosis'] ?></p>
                        </div>
                        <?php endif; ?>
                        
                        <div class="alert alert-light mb-0">
                            <small class="text-muted"><i class="fa-solid fa-user-doctor"></i> Catatan Dokter:</small><br>
                            <p class="mb-0"><?= $riwayat['catatan_dokter'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="alert alert-info text-center">
            <i class="fa-solid fa-info-circle fa-3x mb-3"></i>
            <h5>Belum Ada Riwayat Pemeriksaan</h5>
            <p class="mb-0">Silakan kunjungi posyandu terdekat untuk melakukan pemeriksaan pertama untuk <?= $anak['nama_anak'] ?>.</p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>