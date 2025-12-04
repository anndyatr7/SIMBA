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

// Ambil data anak
$anak_query = "SELECT * FROM data_anak WHERE id_user = $id_user";
$anak_result = mysqli_query($koneksi, $anak_query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Anak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #e7f7fc 0%, #b3e5fc 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Poppins", sans-serif;
        }

        .modal-container {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            max-width: 800px;
            width: 90%;
            animation: fadeIn 0.3s ease;
        }

        .modal-container h2 {
            text-align: center;
            margin-bottom: 10px;
            color: #1e5bf7;
            font-weight: 600;
        }

        .modal-container h4 {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
        }

        .child-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .child-card {
            background: #f8f9fa;
            border: 2px solid #e0e0e0;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .child-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(30, 91, 247, 0.2);
            border-color: #1e5bf7;
        }

        .icon-box {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
            margin-bottom: 10px;
        }

        .icon-box.boy {
            background: linear-gradient(135deg, #1e5bf7, #83ffff);
            color: white;
        }

        .icon-box.girl {
            background: linear-gradient(135deg, #ff68c3, #ff4dc4);
            color: white;
        }

        .icon-box.add {
            background: #e0e0e0;
            color: #666;
        }

        .child-card:hover .icon-box.add {
            background: #1e5bf7;
            color: white;
        }

        .child-name {
            font-weight: 600;
            font-size: 16px;
            color: #333;
        }

        .child-age {
            font-size: 13px;
            color: #666;
        }

        .logout-link {
            text-align: center;
            margin-top: 20px;
        }

        .logout-link a {
            color: #666;
            text-decoration: none;
            font-size: 14px;
        }

        .logout-link a:hover {
            color: #1e5bf7;
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
        }

        .empty-state i {
            font-size: 60px;
            color: #ddd;
            margin-bottom: 20px;
        }

        .empty-state h4 {
            color: #666;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #999;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="modal-container">
    <h2>Halo <?= $user['nama_user'] ?>!</h2>
        <h4>Pilih Jagoan/Princess kamu~</h4>

    <?php if(mysqli_num_rows($anak_result) > 0): ?>
        <div class="child-options">
            <?php while($anak = mysqli_fetch_assoc($anak_result)): ?>
                <?php
                // Hitung usia anak
                $tanggal_lahir = new DateTime($anak['tanggal_lahir']);
                $sekarang = new DateTime();
                $usia = $sekarang->diff($tanggal_lahir);
                $usia_text = $usia->y > 0 ? $usia->y . " tahun" : $usia->m . " bulan";
                ?>
                <a href="dashboard-anak.php?id_anak=<?= $anak['id_anak'] ?>" class="child-card">
                    <div class="icon-box">
                    <i class="<?= $anak['gender'] == 'Laki-laki' ? 'fa-solid fa-mars' : 'fa-solid fa-venus' ?>"></i>
                    </div>
                    <span class="child-name"><?= $anak['nama_anak'] ?></span>
                    <small style="font-size: 12px; color: #666;"><?= $usia_text ?></small>
                </a>
            <?php endwhile; ?>

            <!-- Tombol Tambah Anak -->
            <a href="form-anak.php" class="child-card">
                <div class="icon-box add">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <span class="child-name">Tambah Anak</span>
            </a>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <i class="fa-solid fa-baby"></i>
            <h4>Belum Ada Data Anak</h4>
            <p>Silakan tambahkan data anak terlebih dahulu</p>
            <a href="form-anak.php" class="btn btn-primary mt-3">
                <i class="fa-solid fa-plus me-2"></i>Tambah Anak
            </a>
        </div>
    <?php endif; ?>

    <div class="logout-link">
        <a href="dashboard-ibu.php">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard Ibu
        </a>
        <span class="mx-2">|</span>
        <a href="../backend/logout.php">
            <i class="fa-solid fa-right-from-bracket me-1"></i> Keluar
        </a>
    </div>
</div>

</body>
</html>