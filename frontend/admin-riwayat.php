<?php
session_start();
require "../backend/koneksi.php";

// Ambil semua riwayat pemeriksaan dengan join ke tabel user
$query = "SELECT r.*, u.nama_user, u.nik 
          FROM riwayat_pemeriksaan r 
          JOIN user u ON r.id_user = u.id_user 
          ORDER BY r.tanggal_periksa DESC";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Riwayat Pemeriksaan</title>
    <style>
        body{
            margin-top: 90px;
        }
        .card-header {
            padding: 0 !important;
        }
        .card-main{
            min-height: 100vh;
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
        
        .card-riwayat {
            margin-bottom: 20px;
            border-left: 4px solid #ff68c3;
        }
        
        .badge-status {
            font-size: 0.8rem;
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
        <div class="card card-main text-center mx-auto shadow rounded" style="width: 100%">

            <div class="card-header p-0">
                <ul class="nav nav-tabs w-100 d-flex justify-content-center">
                    <li class="nav-item flex-fill text-center">
                        <a class="nav-link active" href="admin-riwayat.php">Riwayat Pemeriksaan</a>
                    </li>
                    <li class="nav-item flex-fill text-center">
                        <a style="background: white;" class="nav-link" href="admin-tambah.php">Tambah Riwayat Pemeriksaan</a>
                    </li>
                </ul>
            </div>

            <div class="card-body p-4">
                <?php if(mysqli_num_rows($result) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <div class="card card-riwayat">
                            <div class="card-body text-start">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5 class="card-title mb-3">
                                            <i class="bi bi-person-circle"></i> <?= $row['nama_user'] ?>
                                            <span class="badge bg-secondary ms-2">NIK: <?= $row['nik'] ?></span>
                                        </h5>
                                        
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <small class="text-muted">📅 Tanggal Pemeriksaan:</small>
                                                <p class="mb-1"><strong><?= date('d F Y', strtotime($row['tanggal_periksa'])) ?></strong></p>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted">🤰 Usia Kehamilan:</small>
                                                <p class="mb-1"><strong><?= $row['usia_kehamilan'] ?> minggu</strong></p>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-2">
                                            <div class="col-md-4">
                                                <small class="text-muted">Tinggi Badan:</small>
                                                <p class="mb-0"><?= $row['tinggi_badan'] ?> cm</p>
                                            </div>
                                            <div class="col-md-4">
                                                <small class="text-muted">Berat Badan:</small>
                                                <p class="mb-0"><?= $row['berat_badan'] ?> kg</p>
                                            </div>
                                            <div class="col-md-4">
                                                <small class="text-muted">Tekanan Darah:</small>
                                                <p class="mb-0"><?= $row['tekanan_darah'] ?></p>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-2">
                                            <div class="col-md-4">
                                                <small class="text-muted">Tinggi Fundus:</small>
                                                <p class="mb-0"><?= $row['tinggi_fundus'] ?> cm</p>
                                            </div>
                                            <div class="col-md-4">
                                                <small class="text-muted">Denyut Jantung Bayi:</small>
                                                <p class="mb-0"><?= $row['denyut_jantung'] ?> /menit</p>
                                            </div>
                                            <div class="col-md-4">
                                                <small class="text-muted">Aktivitas Bayi:</small>
                                                <p class="mb-0"><?= $row['aktivitas_bayi'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <small class="text-muted">💊 Tablet TTD:</small>
                                            <?php if($row['tablet_ttd'] == 'Ya'): ?>
                                                <span class="badge bg-success ms-2">Diberikan</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger ms-2">Tidak</span>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <small class="text-muted">😷 Keluhan:</small>
                                            <p class="mb-0"><strong><?= $row['keluhan'] ?></strong></p>
                                        </div>
                                        
                                        <div>
                                            <small class="text-muted">📝 Catatan Dokter:</small>
                                            <p class="mb-0" style="font-size: 0.9rem;"><?= $row['catatan_dokter'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> Belum ada riwayat pemeriksaan yang tercatat.
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>
</html>