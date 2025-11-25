<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Ibu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="styling/buatibu.css?v<?php echo time();?>">
</head>
<body>

<!-- NAVBAR -->
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
    <a href="dashboard-ibu.php" class="nav-item active">
        <i class="fa-solid fa-house"></i> Dashboard
    </a>
    <a href="riwayat-ibu.php" class="nav-item">
        <i class="fa-regular fa-file-lines"></i> Riwayat
    </a>
    <a href="edukasi-ibu.php" class="nav-item">
        <i class="fa-regular fa-book-open"></i> Edukasi
    </a>
</div>

<!-- WELCOME BANNER -->
<div class="welcome-banner">
    <h4>Selamat Datang, nama! 👋</h4>
    <p>Pantau kesehatan kehamilan Anda dan dapatkan informasi terkini tentang layanan posyandu</p>
</div>

<!-- ROW 1 : ANNOUNCEMENT (LEFT)  +  COLUMN KANAN -->
<div class="row-atas">

    <!-- KIRI -->
    <div class="left-announcement-box">
        <h4 class="ann-title">Announcement</h4>

        <div class="ann-card pink-card">
            <div class="pink-icon">
                <i class="fa-regular fa-calendar"></i>
            </div>

            <div class="ann-content">
                <h5>judul?</h5>
                <p>dokter?</p>
                <span class="ann-date">jadwal? · waktu?</span>
            </div>

            <span class="ann-badge">hari?</span>
        </div>

        <div class="ann-card blue-card">
            <div class="blue-icon">
                <i class="fa-regular fa-pen-to-square"></i>
            </div>

            <div class="ann-content">
                <h5>Pesan Dokter</h5>
                <p>Dr. Nathania</p>
                <p>Lorem Ipsum hdgasdg ashdgwegh asjdgdbb dsfhbhfhe ubisdjjjjnffff ffffffffff ffffffff ffffffff ffffffeeeeeeeeeee eeeeeeeeeeeeeeeeeeeeeebj fdddh Lorem Ipsum hdgasdg ashdgwegh asjdgdbb dsfhbhfhe ubisdjjjjnffff ffffffffff ffffffff ffffffff ffffffeeeeeeeeeee eeeeeeeeeeeeeeeeeeeeeebj fdddh Lorem Ipsum hdgasdg ashdgwegh asjdgdbb dsfhbhfhe ubisdjjjjnffff ffffffffff ffffffff ffffffff ffffffeeeeeeeeeee eeeeeeeeeeeeeeeeeeeeeebj fdddh</p>
            </div>
        </div>
    </div>

    <!-- KANAN -->
    <div class="right-column">

        <!-- INFO CARDS -->
        <div class="left-info">

            <div class="info-card pink-card2">
                <div class="info-icon"><i class="fa-regular fa-heart"></i></div>
                <div class="info-label">Usia Kehamilan</div>
                <div class="info-value">1 hari</div>
            </div>

            <div class="info-card purple-card2">
                <div class="info-icon"><i class="fa-regular fa-calendar-check"></i></div>
                <div class="info-label">Kunjungan Berikutnya</div>
                <div class="info-value">kapan yaa</div>
            </div>

            <div class="info-card blue-card2">
                <div class="info-icon"><i class="fa-solid fa-heart-pulse"></i></div>
                <div class="info-label">Status Kehamilan</div>
                <div class="info-value">baik or no</div>
            </div>

            <div class="info-card orange-card2">
                <div class="info-icon"><i class="fa-solid fa-file-medical"></i></div>
                <div class="info-label">Pemeriksaan</div>
                <div class="info-value">brp kali hayooo</div>
            </div>

        </div>

        <div class="tips-box">
            <h4 class="tips-title">Tips Kesehatan Minggu Ini</h4>

            <div class="tip-item">
                <span class="tip-number">1</span>
                <div class="tip-text">
                    <b>Nutrisi Seimbang</b>
                    <p>Konsumsi makanan kaya zat besi seperti bayam, daging merah, dan kacang-kacangan.</p>
                </div>
            </div>

            <div class="tip-item">
                <span class="tip-number">2</span>
                <div class="tip-text">
                    <b>Olahraga Ringan</b>
                    <p>Lakukan yoga atau jalan santai 20–30 menit setiap hari.</p>
                </div>
            </div>

            <div class="tip-item">
                <span class="tip-number">3</span>
                <div class="tip-text">
                    <b>Istirahat Cukup</b>
                    <p>Tidur 7–9 jam dan istirahat jika merasa lelah.</p>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>
