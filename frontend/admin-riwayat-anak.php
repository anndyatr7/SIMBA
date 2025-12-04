<?php 
require "../backend/koneksi.php";

if(!isset($_GET['id_anak'])){
    header("location: admin-dashboard-anak.php");
    exit;
}

$id_anak = $_GET['id_anak'];

// Ambil data anak dengan nama ibu
$query = "SELECT da.*, u.nama_user as nama_ibu, u.alamat 
          FROM data_anak da 
          JOIN user u ON da.id_user = u.id_user 
          WHERE da.id_anak='$id_anak'";
$result = mysqli_query($koneksi, $query);
$data_anak = mysqli_fetch_assoc($result);

if(!$data_anak){
    echo "<script>
            alert('Data anak tidak ditemukan!');
            window.location.href = 'admin-dashboard-anak.php';
          </script>";
    exit;
}

// Hitung usia anak
$tanggal_lahir = new DateTime($data_anak['tanggal_lahir']);
$sekarang = new DateTime();
$usia = $sekarang->diff($tanggal_lahir);
$usia_text = $usia->y > 0 ? $usia->y . " tahun " . $usia->m . " bulan" : $usia->m . " bulan";

// Ambil riwayat pemeriksaan
$query_riwayat = "SELECT * FROM riwayat_pemeriksaan_anak WHERE id_anak='$id_anak' ORDER BY tanggal_periksa DESC";
$riwayat = mysqli_query($koneksi, $query_riwayat);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Riwayat Anak - <?= $data_anak['nama_anak'] ?></title>
    <style>
        body{
            margin-top: 90px;
        }
        .card-header {
            padding: 0 !important;
        }
        .card-main{
            min-height: 100vh;
            background: rgba(231, 247, 252, 1);
        }

        .nav-tabs .nav-link.active {
            color: #000 !important;        
            font-weight: 700 !important;
        }

        .nav-tabs .nav-link {
            color: rgba(0, 0, 0, 0.5) !important;
            font-weight: 500;
        }
    </style>
    <link rel="stylesheet" href="styling/buatindex.css?v<?php echo time();?>" >
    <link rel="stylesheet" href="styling/buatadmin.css?v<?php echo time();?>" >
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
            <a href="admin-dashboard-anak.php">Kembali</a>
            <a href="../backend/delete-anak.php?id_anak=<?= $id_anak ?>">Hapus User</a>
        </div>
    </nav>
    <!-- NavBar End -->

    <div class="container mt-4 mb-4">
        <div class="card card-main text-center mx-auto shadow rounded" style="width: 100%">

            <div class="card-header p-0">
                <ul class="nav nav-tabs w-100 d-flex justify-content-center">
                    <li class="nav-item flex-fill text-center">
                        <a class="nav-link active" href="admin-riwayat-anak.php?id_anak=<?= $id_anak ?>">Riwayat Pemeriksaan</a>
                    </li>
                    <li class="nav-item flex-fill text-center">
                        <a style="background: white;" class="nav-link" href="admin-tambah-anak.php?id_anak=<?= $id_anak ?>">Tambah Riwayat Pemeriksaan</a>
                    </li>
                </ul>
            </div>

            <!-- Informasi Anak -->
            <div class="card-body p-4 bg-light">
                <div class="text-start">
                    <h5>Informasi Pasien</h5>
                    <div class="row">
                        <div class="col-6">
                            <p class="mb-1"><strong>Nama Anak:</strong> <?= $data_anak['nama_anak'] ?></p>
                            <p class="mb-1"><strong>Tanggal Lahir:</strong> <?= date('d F Y', strtotime($data_anak['tanggal_lahir'])) ?></p>
                            <p class="mb-1"><strong>Usia:</strong> <?= $usia_text ?></p>
                        </div>
                        <div class="col-6">
                            <p class="mb-1"><strong>Jenis Kelamin:</strong> <?= $data_anak['gender'] ?></p>
                            <p class="mb-1"><strong>Nama Ibu:</strong> <?= $data_anak['nama_ibu'] ?></p>
                            <p class="mb-1"><strong>Alamat:</strong> <?= $data_anak['alamat'] ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <?php 
            if(mysqli_num_rows($riwayat) > 0){
                while($row = mysqli_fetch_assoc($riwayat)){
            ?>
            <div class="card-body p-4">
                <div class="card card-riwayat">
                    <div class="card-body" style="height:fit-content">
                        <div class="isi-data">
                            <div class="keterangan">
                                <p>Tanggal Periksa</p>
                                <p>Usia (bulan)</p>
                                <p>Berat Badan</p>
                                <p>Tinggi Badan</p>
                                <p>Lingkar Kepala</p>
                                <p>Lingkar Lengan</p>
                                <p>Status Gizi</p>
                                <p>Imunisasi</p>
                                <p>Vitamin</p>
                                <p>Keluhan</p>
                                <p>Diagnosis</p>
                                <p>Catatan Dokter</p>
                            </div>
                            <div class="datanya">
                                <p><?= date('d F Y', strtotime($row['tanggal_periksa'])); ?></p>
                                <p><?= $row['usia_bulan']; ?> bulan</p>
                                <p><?= $row['berat_badan']; ?> kg</p>
                                <p><?= $row['tinggi_badan']; ?> cm</p>
                                <p><?= $row['lingkar_kepala']; ?> cm</p>
                                <p><?= $row['lingkar_lengan']; ?> cm</p>
                                <p><?= $row['status_gizi']; ?></p>
                                <p><?= $row['imunisasi'] ?: '-'; ?></p>
                                <p><?= $row['vitamin'] ?: '-'; ?></p>
                                <p><?= $row['keluhan'] ?: '-'; ?></p>
                                <p><?= $row['diagnosis'] ?: '-'; ?></p>
                                <p><?= $row['catatan_dokter']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }
            } else{
            ?>
            <div class="card-body p-4">
                <div class="card card-riwayat">
                    <div class="card-body" style="height:fit-content">
                        <p>Belum Ada Riwayat Pemeriksaan</p>
                        <a href="admin-tambah-anak.php?id_anak=<?= $id_anak ?>" class="btn btn-primary mt-2">Tambah Pemeriksaan Pertama</a>
                    </div>
                </div>
            </div>
            <?php }?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>
</html>