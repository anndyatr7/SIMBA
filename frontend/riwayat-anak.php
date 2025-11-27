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
    <a href="dashboard-anak.php" class="nav-item"><i class="fa-solid fa-house"></i> Dashboard</a>
    <a href="riwayat-anak.php" class="nav-item active"><i class="fa-regular fa-file-lines"></i> Riwayat</a>
</div>