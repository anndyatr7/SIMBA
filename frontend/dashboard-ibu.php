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

// data bayi
$anak_query = "SELECT * FROM data_anak WHERE id_user = $id_user";
$anak_result = mysqli_query($koneksi, $anak_query);

// Ambil riwayat pemeriksaan terakhir
$riwayat_query = "SELECT * FROM riwayat_pemeriksaan WHERE id_user = $id_user ORDER BY tanggal_periksa DESC LIMIT 1";
$riwayat_result = mysqli_query($koneksi, $riwayat_query);
$riwayat_terakhir = mysqli_fetch_assoc($riwayat_result);

// Hitung total pemeriksaan
$total_query = "SELECT COUNT(*) as total FROM riwayat_pemeriksaan WHERE id_user = $id_user";
$total_result = mysqli_query($koneksi, $total_query);
$total_data = mysqli_fetch_assoc($total_result);
$total_pemeriksaan = $total_data['total'];

// Hitung usia kehamilan (dari riwayat terakhir)
$usia_kehamilan = $riwayat_terakhir ? $riwayat_terakhir['usia_kehamilan'] . " Minggu" : "Belum Ada Data";

// Status kehamilan berdasarkan pemeriksaan terakhir
$status_kehamilan = "Belum Ada Data";
if($riwayat_terakhir){
    $tekanan = explode('/', $riwayat_terakhir['tekanan_darah']);
    $sistol = (int)$tekanan[0];
    
    if($sistol < 140 && $riwayat_terakhir['denyut_jantung'] >= 120 && $riwayat_terakhir['denyut_jantung'] <= 160){
        $status_kehamilan = "Baik";
    } else {
        $status_kehamilan = "Perlu Perhatian";
    }
}
?>
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

        <button class="switch-btn" id="openSwitchAnak">
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

<!-- NAVIGATION -->
<div class="custom-nav">
    <a href="dashboard-ibu.php" class="nav-item active">
        <i class="fa-solid fa-house"></i> Dashboard
    </a>
    <a href="riwayat-ibu.php" class="nav-item">
        <i class="fa-regular fa-file-lines"></i> Riwayat
    </a>
    <a href="pemantauan-ibu.php" class="nav-item">
        <i class="fa-regular fa-book-open"></i> Pemantauan
    </a>
    <a href="edukasi-ibu.php" class="nav-item">
        <i class="fa-regular fa-book-open"></i> Edukasi
    </a>
</div>

<!-- WELCOME BANNER -->
<div class="welcome-banner">
    <h4>Selamat Datang, <?= $user['nama_user'] ?>! 👋</h4>
    <p>Pantau kesehatan kehamilan Anda dan dapatkan informasi terkini tentang layanan posyandu</p>
</div>

<!-- ROW 1 : ANNOUNCEMENT (LEFT)  +  COLUMN KANAN -->
<div class="row-atas">

    <!-- KIRI -->
    <div class="left-announcement-box">
        <h4 class="ann-title">Pemeriksaan Terakhir</h4>

        <?php if($riwayat_terakhir): ?>
        <div class="ann-card pink-card">
            <div class="pink-icon">
                <i class="fa-regular fa-calendar"></i>
            </div>

            <div class="ann-content">
                <h5>Pemeriksaan Rutin</h5>
                <p><?= date('d F Y', strtotime($riwayat_terakhir['tanggal_periksa'])) ?></p>
                <span class="ann-date">Usia Kehamilan: <?= $riwayat_terakhir['usia_kehamilan'] ?> minggu</span>
            </div>

            <span class="ann-badge"><?= date('d M', strtotime($riwayat_terakhir['tanggal_periksa'])) ?></span>
        </div>

        <div class="ann-card blue-card">
            <div class="blue-icon">
                <i class="fa-regular fa-pen-to-square"></i>
            </div>

            <div class="ann-content">
                <h5>Catatan Dokter</h5>
                <p><?= $riwayat_terakhir['catatan_dokter'] ?></p>
            </div>
        </div>
        <?php else: ?>
        <div class="alert alert-info">
            Belum ada riwayat pemeriksaan. Silakan kunjungi posyandu untuk pemeriksaan pertama Anda.
        </div>
        <?php endif; ?>
    </div>

    <!-- KANAN -->
    <div class="right-column">

        <!-- INFO CARDS -->
        <div class="left-info">

            <div class="info-card pink-card2">
                <div class="info-icon"><i class="fa-regular fa-heart"></i></div>
                <div class="info-label">Usia Kehamilan</div>
                <div class="info-value"><?= $usia_kehamilan ?></div>
            </div>

            <div class="info-card purple-card2">
                <div class="info-icon"><i class="fa-regular fa-calendar-check"></i></div>
                <div class="info-label">Kunjungan Berikutnya</div>
                <div class="info-value">
                    <?php 
                    if($riwayat_terakhir){
                        $next_date = date('d M Y', strtotime($riwayat_terakhir['tanggal_periksa'] . ' +30 days'));
                        echo $next_date;
                    } else {
                        echo "Belum Ada";
                    }
                    ?>
                </div>
            </div>

            <div class="info-card blue-card2">
                <div class="info-icon"><i class="fa-solid fa-heart-pulse"></i></div>
                <div class="info-label">Status Kehamilan</div>
                <div class="info-value"><?= $status_kehamilan ?></div>
            </div>

            <div class="info-card orange-card2">
                <div class="info-icon"><i class="fa-solid fa-file-medical"></i></div>
                <div class="info-label">Pemeriksaan</div>
                <div class="info-value"><?= $total_pemeriksaan ?> Kali</div>
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

<!-- MODAL SWITCH LAYANAN ANAK -->
<div id="modalAnak" class="modal-overlay">
    <div class="modal-box">
        <h4>Halo <?= $user['nama_user'] ?>!<br>Pilih Jagoan/Princess kamu~</h4>

        <div class="child-options">
            <?php 
            if(mysqli_num_rows($anak_result) > 0){
                while($anak = mysqli_fetch_assoc($anak_result)){
                    // Hitung usia anak
                    $tanggal_lahir = new DateTime($anak['tanggal_lahir']);
                    $sekarang = new DateTime();
                    $usia = $sekarang->diff($tanggal_lahir);
                    $usia_text = $usia->y > 0 ? $usia->y . " tahun" : $usia->m . " bulan";
            ?>
            <!-- Anak yang sudah terdaftar -->
            <a href="dashboard-anak.php?id_anak=<?= $anak['id_anak'] ?>" class="child-card" style="text-decoration: none; color: inherit;">
                <div class="icon-box">
                    <i class="<?= $anak['gender'] == 'Laki-laki' ? 'fa-solid fa-mars' : 'fa-solid fa-venus' ?>"></i>
                </div>
                <span class="child-name"><?= $anak['nama_anak'] ?></span>
                <small style="font-size: 12px; color: #666;"><?= $usia_text ?></small>
            </a>
            <?php 
                }
            }
            ?>

            <!-- Tombol tambah anak -->
            <div class="child-card" id="openTambahAnak" style="cursor: pointer;">
                <div class="icon-box">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <span class="child-name">Tambah Anak</span>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH ANAK -->
<div id="modalTambahAnak" class="modal-overlay">
    <div class="modal-box" style="max-width: 600px;">
        <h4>Tambah Data Anak</h4>
        
        <form action="../backend/tambah-anak.php" method="POST">
            <div class="row g-3 mt-2">
                <div class="col-12">
                    <label>Nama Anak</label>
                    <input type="text" class="form-control" name="nama_anak" required>
                </div>
                
                <div class="col-6">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir" required>
                </div>
                
                <div class="col-6">
                    <label>Jenis Kelamin</label>
                    <select class="form-control" name="gender" required>
                        <option value="">Pilih</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                
                <div class="col-4">
                    <label>Golongan Darah</label>
                    <select class="form-control" name="golongan_darah">
                        <option value="">Pilih</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>
                
                <div class="col-4">
                    <label>Berat Lahir (kg)</label>
                    <input type="number" step="0.01" class="form-control" name="berat_lahir" placeholder="3.2">
                </div>
                
                <div class="col-4">
                    <label>Tinggi Lahir (cm)</label>
                    <input type="number" step="0.01" class="form-control" name="tinggi_lahir" placeholder="50">
                </div>
                
                <div class="col-12 d-flex gap-2">
                    <button type="submit" name="tambah_anak" class="btn btn-primary w-50">Simpan</button>
                    <button type="button" class="btn btn-secondary w-50" onclick="closeTambahAnak()">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    const modalAnak = document.getElementById("modalAnak");
    const modalTambahAnak = document.getElementById("modalTambahAnak");
    const openSwitch = document.getElementById("openSwitchAnak");
    const openTambah = document.getElementById("openTambahAnak");

    // Buka modal pilih anak
    openSwitch.addEventListener("click", () => {
        modalAnak.style.display = "flex";
    });

    // Tutup modal pilih anak
    modalAnak.addEventListener("click", (e) => {
        if(e.target === modalAnak){
            modalAnak.style.display = "none";
        }
    });

    // Buka modal tambah anak
    openTambah.addEventListener("click", () => {
        modalAnak.style.display = "none";
        modalTambahAnak.style.display = "flex";
    });

    // Tutup modal tambah anak
    modalTambahAnak.addEventListener("click", (e) => {
        if(e.target === modalTambahAnak){
            modalTambahAnak.style.display = "none";
        }
    });

    function closeTambahAnak() {
        modalTambahAnak.style.display = "none";
    }
</script>

</body>
</html>