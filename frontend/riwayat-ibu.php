<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat</title>
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

    <a href="riwayat-ibu.php" class="nav-item active">
        <i class="fa-regular fa-file-lines"></i> Riwayat
    </a>

    <a href="edukasi-ibu.php" class="nav-item">
        <i class="fa-regular fa-book-open"></i> Edukasi
    </a>
</div>

</body>
</html>