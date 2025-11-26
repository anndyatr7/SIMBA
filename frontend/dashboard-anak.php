<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Anak</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="styling/buatanak.css?v<?php echo time();?>">
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="left">
        <div class="logo">
            <i class="fa-solid fa-baby"></i>
        </div>

        <div class="text">
            <div class="title">Layanan Ibu</div>
            <div class="subtitle">Posyandu Sehat</div>
        </div>

        <a href="dashboard-ibu.php"class="switch-btn">
            Beralih ke Layanan Anak
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
    <a href="#" class="nav-item"><i class="fa-regular fa-file-lines"></i> Riwayat</a>
    <a href="#" class="nav-item"><i class="fa-regular fa-book-open"></i> Edukasi</a>
</div>

<!-- WELCOME -->
<div class="welcome-banner">
    <h4>Selamat Datang, nama! 👋</h4>
    <p>Pantau tumbuh kembang anak Anda dan kelola imunisasi dengan mudah</p>
</div>

<!-- GRID LAYOUT -->
<div class="main-grid">

    <!-- Grafik -->
    <div class="growth-card">
        <h4 class="section-title">Grafik Umur & Berat Badan</h4>
        <div class="chart-box">
            <p class="chart-placeholder">Grafik umur dan berat badan muncul di sini</p>
        </div>
    </div>

    <!-- Usia Anak -->
    <div class="info-card age-card">
        <div class="info-icon"><i class="fa-regular fa-calendar"></i></div>
        <div class="info-label">Usia Anak</div>
        <div class="info-value">2 Tahun</div>
    </div>

    <!-- Perkembangan -->
    <div class="info-card dev-card">
        <div class="info-icon"><i class="fa-solid fa-trophy"></i></div>
        <div class="info-label">Perkembangan</div>
        <div class="info-value">95%</div>
    </div>

    <!-- Menu Cepat -->
    <div class="quick-menu-card">
        <h4 class="menu-title">Menu Cepat</h4>

        <div class="menu-item imunisasi">
            <div class="menu-icon"><i class="fa-solid fa-syringe"></i></div>
            <div>
                <div class="menu-name">Jadwal Imunisasi</div>
                <div class="menu-desc">DPT-HB-Hib 4</div>
            </div>
        </div>

        <div class="menu-item tumbuh">
            <div class="menu-icon"><i class="fa-solid fa-heart-pulse"></i></div>
            <div>
                <div class="menu-name">Cek Tumbuh Kembang</div>
                <div class="menu-desc">Pemeriksaan rutin</div>
            </div>
        </div>

        <div class="achievement-card">
            <div class="ach-icon"><i class="fa-solid fa-award"></i></div>
            <div class="ach-title">Pencapaian</div>
            <div class="ach-desc">Anak Anda sudah mencapai 8 milestone perkembangan!</div>
            <button class="ach-button">Lihat Detail</button>
        </div>
    </div>

</div>

</body>
</html>
