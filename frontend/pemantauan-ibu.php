<?php
session_start();
require "../backend/koneksi.php";

// Cek login
if(!isset($_SESSION['id_user'])){
    header("location: homepage.php");
    exit;
}

$id_user = $_SESSION['id_user'];

// Ambil data user
$user_query = "SELECT * FROM user WHERE id_user = $id_user";
$user_result = mysqli_query($koneksi, $user_query);
$user = mysqli_fetch_assoc($user_result);

// Ambil riwayat ibu terbaru
$q = mysqli_query($koneksi, "
    SELECT usia_hamil 
    FROM riwayat_ibu 
    WHERE id_user = '$id_user'
    ORDER BY tanggal_periksa DESC 
    LIMIT 1
");

$riwayat = mysqli_fetch_assoc($q);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemantauan</title>
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
                <div class="name"><?= $user['nama_user'] ?></div>
                <div class="email"><?= $user['email'] ?></div>
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

        <a href="pemantauan-ibu.php" class="nav-item active">
        <i class="fa-regular fa-book-open"></i> Pemantauan
        </a>

        <a href="edukasi-ibu.php" class="nav-item">
            <i class="fa-regular fa-book-open"></i> Edukasi
        </a>
    </div>

    <br>

    <?php
    // Ambil keluhan dari tabel keluhan
    $kq = mysqli_query($koneksi, "SELECT * FROM keluhan");
    // Jika belum ada riwayat
    if (!$riwayat) {
        echo "<div class='alert alert-warning text-center mt-4'>
                Silakan datang ke posyandu terlebih dahulu agar usia kehamilan dapat dicatat.
            </div>";
        exit;
    }
    
    $minggu = $riwayat['usia_hamil'];
    ?>

    <h3>Pemantauan Minggu Kehamilan: <?= $minggu ?></h3>

    <form method="POST" action="simpan_pantauan.php">
        <input type="hidden" name="minggu_ke" value="<?= $minggu ?>">

        <?php while ($k = mysqli_fetch_assoc($kq)): ?>

            <label style="display:block; margin-bottom:10px;">
                <input type="checkbox" name="keluhan[]" value="<?= $k['id_keluhan'] ?>">
                <?= $k['nama_keluhan'] ?>
            </label>

        <?php endwhile; ?>

        <button type="submit" class="btn btn-primary">
            Simpan Pantauan
        </button>
    </form>

    <?php
    // ambil tanggal hari ini
    $bulan = date("m");
    $hari  = date("d");

    // cek apakah user sudah input ttd hari ini
    $cek_ttd = mysqli_query($koneksi, "
        SELECT * FROM pantauan_ttd 
        WHERE id_user = '$id_user' AND bulan = '$bulan' AND hari = '$hari'
    ");

    $ttd_ada = mysqli_fetch_assoc($cek_ttd);
    ?>

    <hr><br>

    <h3>Pemantauan TTD (Tablet Tambah Darah)</h3>

    <?php if ($ttd_ada): ?>

        <div class="alert alert-success">
            Anda sudah mengisi TTD untuk hari ini ✔
        </div>

    <?php else: ?>

    <form method="POST" action="simpan_ttd.php">
        <p>Apakah Anda sudah minum TTD hari ini?</p>

        <label>
            <input type="checkbox" name="status" value="1">
            Ya, saya sudah minum TTD
        </label>

        <input type="hidden" name="bulan" value="<?= $bulan ?>">
        <input type="hidden" name="hari" value="<?= $hari ?>">

        <button class="btn btn-primary mt-2">Simpan</button>
    </form>

    <?php endif; ?>
</body>
</html>