<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edukasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="styling/buatibu.css?v<?php echo time();?>">
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
            <div class="name">sabrina alya</div>
            <div class="email">contoh@gmail.com</div>
        </div>

        <button class="logout-btn">
            Keluar
        </button>
    </div>
</div>

<br><br>

<div class="custom-nav">
    <a href="dashboard-ibu.php" class="nav-item ">
        <i class="fa-solid fa-house"></i> Dashboard
    </a>

    <a href="riwayat-ibu.php" class="nav-item">
        <i class="fa-regular fa-file-lines"></i> Riwayat
    </a>

    <a href="edukasi-ibu.php" class="nav-item active">
        <i class="fa-regular fa-book-open"></i> Edukasi
    </a>
</div>

<br>

<div class="container mt-4">
    <div class="row g-4">

        <!-- CARD 1 -->
        <div class="col-md-3">
            <div class="card">
                <img src="https://infostunting.wonogirikab.go.id/assets/upload/image/tiny_20200918080611.png" class="card-img-top" alt="gambar edukasi 1" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Cara Menjaga Kehamilan</h5>
                    <p class="card-text">
                        • Makan bergizi seimbang.<br>
                        • Minum air cukup.<br>
                        • Istirahat cukup.<br>
                        • Rutin periksa kehamilan.
                    </p>
                </div>
            </div>
        </div>

        <!-- CARD 2 -->
        <div class="col-md-3">
            <div class="card">
                <img src="https://d324bm9stwnv8c.cloudfront.net/artikel/20180726104607.105-573821179.jpg" class="card-img-top" alt="gambar edukasi 2" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Tanda Bahaya Kehamilan</h5>
                    <p class="card-text">
                        • Perdarahan.<br>
                        • Gerakan janin berkurang.<br>
                        • Pandangan kabur.<br>
                        • Nyeri perut hebat.
                    </p>
                </div>
            </div>
        </div>

        <!-- CARD 3 -->
        <div class="col-md-3">
            <div class="card">
                <img src="https://assets-a1.kompasiana.com/items/album/2022/10/22/whatsapp-image-2022-10-22-at-20-41-08-6353fb714addee2f94229b02.jpeg" class="card-img-top" alt="gambar edukasi 3" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Persiapan Persalinan</h5>
                    <p class="card-text">
                        • Siapkan tas persalinan.<br>
                        • Kenali kontraksi asli.<br>
                        • Diskusi metode lahiran.<br>
                        • Pendamping harus siap.
                    </p>
                </div>
            </div>
        </div>

        <!-- CARD 4 -->
        <div class="col-md-3">
            <div class="card">
                <img src="https://www.shutterstock.com/image-vector/woman-holding-her-cute-baby-600nw-2549773923.jpg" class="card-img-top" alt="gambar edukasi 4" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Perawatan Bayi Baru Lahir</h5>
                    <p class="card-text">
                        • IMD segera.<br>
                        • Ganti popok rutin.<br>
                        • Rawat tali pusat.<br>
                        • Imunisasi tepat jadwal.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>