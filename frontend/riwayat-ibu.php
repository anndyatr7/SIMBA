<?php
session_start();
require "../backend/koneksi.php";

// Cek apakah user sudah login
if(!isset($_SESSION['id_user'])){
    header("location: homepage.php");
    exit;
}

$id_user = $_SESSION['id_user'];

// Ambil data user
$user_query = "SELECT * FROM user WHERE id_user = $id_user";
$user_result = mysqli_query($koneksi, $user_query);
$user = mysqli_fetch_assoc($user_result);

// Ambil semua riwayat pemeriksaan user
$riwayat_query = "SELECT * FROM riwayat_ibu WHERE id_user = $id_user ORDER BY tanggal_periksa DESC";
$riwayat_result = mysqli_query($koneksi, $riwayat_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pemeriksaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="styling/buatibu.css?v<?php echo time();?>">
    <style>
        .timeline-card {
            border-left: 3px solid #ff68c3;
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
   <div class="navbar">
    <div class="left">
        <div class="logo">
            <i class="fa-solid fa-heart"></i>
        </div>

        <div class="text">
            <div class="title">Layanan Ibu</div>
            <div class="subtitle">Posyandu Sehat</div>
        </div>

        <button class="switch-btn">
            Beralih ke Layanan Anak
        </button>
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

<div class="custom-nav">
    <a href="dashboard-ibu.php" class="nav-item">
        <i class="fa-solid fa-house"></i> Dashboard
    </a>

    <a href="riwayat-ibu.php" class="nav-item active">
        <i class="fa-regular fa-file-lines"></i> Riwayat
    </a>

    <a href="pemantauan-ibu.php" class="nav-item">
        <i class="fa-regular fa-book-open"></i> Pemantauan
    </a>

    <a href="edukasi-ibu.php" class="nav-item">
        <i class="fa-regular fa-book-open"></i> Edukasi
    </a>
</div>

<br>

<div class="container mt-4 mb-5">
    <h3 class="mb-4"> Riwayat Pemeriksaan Kehamilan Anda</h3>
    
    <?php if(mysqli_num_rows($riwayat_result) > 0): ?>
        <?php while($riwayat = mysqli_fetch_assoc($riwayat_result)): ?>
        <div class="card timeline-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="card-title mb-0">
                        <i class="fa-regular fa-calendar text-primary"></i> 
                        <?= date('d F Y', strtotime($riwayat['tanggal_periksa'])) ?>
                    </h5>
                    <span class="badge bg-info">Minggu ke-<?= $riwayat['usia_hamil'] ?></span>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3">Data Pengukuran</h6>
                        
                        <div class="detail-row">
                            <span><i class="fa-solid fa-ruler-vertical text-success"></i> Tinggi Badan</span>
                            <strong><?= $riwayat['tiba'] ?> cm</strong>
                        </div>
                        
                        <div class="detail-row">
                            <span><i class="fa-solid fa-weight-scale text-warning"></i> Berat Badan</span>
                            <strong><?= $riwayat['beba'] ?> kg</strong>
                        </div>
                        
                        <div class="detail-row">
                            <span><i class="fa-solid fa-heart-pulse text-danger"></i> Tekanan Darah</span>
                            <strong><?= $riwayat['tensi'] ?> mmHg</strong>
                        </div>
                        
                        <div class="detail-row">
                            <span><i class="fa-solid fa-arrows-up-down text-primary"></i> Tinggi Fundus</span>
                            <strong><?= $riwayat['tfu'] ?> cm</strong>
                        </div>
                        
                        <div class="detail-row">
                            <span><i class="fa-solid fa-heartbeat text-danger"></i> Denyut Jantung Bayi</span>
                            <strong><?= $riwayat['denyut'] ?> bpm</strong>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3">Kondisi & Catatan</h6>
                        
                        <div class="mb-3">
                            <small class="text-muted">Aktivitas Bayi:</small><br>
                            <span class="badge bg-success"><?= $riwayat['aktivitas'] ?></span>
                        </div>
                        
                        <div class="mb-3">
                            <small class="text-muted">Tablet TTD:</small><br>
                            <?php if($riwayat['ttd'] == 'Ya'): ?>
                                <span class="badge bg-success">✓ Diberikan</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Tidak Diberikan</span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mb-3">
                            <small class="text-muted">Keluhan:</small><br>
                            <p class="mb-0"><?= $riwayat['keluhan'] ?></p>
                        </div>
                        
                        <div class="alert alert-light mb-0">
                            <small class="text-muted"><i class="fa-solid fa-user-doctor"></i> Catatan Dokter:</small><br>
                            <p class="mb-0"><?= $riwayat['pesan'] ?></p>
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
            <p class="mb-0">Silakan kunjungi posyandu terdekat untuk melakukan pemeriksaan kehamilan Anda.</p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>