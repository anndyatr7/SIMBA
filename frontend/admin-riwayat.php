<?php 
require "../backend/koneksi.php";

if(!isset($_GET['id_user'])){
    header("location: admin-dashboard-ibu.php");
    exit;
}

$id_ibu = $_GET['id_user'];

$query = "SELECT * FROM user WHERE id_user='$id_ibu'";
$result = mysqli_query($koneksi, $query);
$data_ibu = mysqli_fetch_assoc($result);

if(!$data_ibu){
    echo "<script>
            alert('Data ibu tidak ditemukan!');
            window.location.href = 'admin-dashboard-ibu.php';
          </script>";
    exit;
}

$query_riwayat = "SELECT * FROM riwayat_pemeriksaan WHERE id_user='$id_ibu' ORDER BY tanggal_periksa DESC";
$riwayat = mysqli_query($koneksi, $query_riwayat);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Riwayat Pemeriksaan - <?= $data_ibu['nama_user'] ?></title>
    <style>
        body{
            margin-top: 90px;
        }
        .card-header {
            padding: 0 !important;
        }
        .card-main{
            min-height: 100vh;
            background: rgba(255, 255, 255, 1);
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
            <a href="admin-dashboard-ibu.php">Kembali</a>
            <a href="../backend/delete-user.php?id_user=<?= $id_ibu ?>">Hapus User</a>
        </div>
    </nav>
    <!-- NavBar End -->

    <div class="container mt-4 mb-4">
        <div class="card card-main text-center mx-auto shadow rounded" style="width: 100%">

            <div class="card-header p-0">
                <ul class="nav nav-tabs w-100 d-flex justify-content-center">
                    <li class="nav-item flex-fill text-center">
                        <!-- PERBAIKAN: Tambahkan id_user di URL -->
                        <a class="nav-link active" href="admin-riwayat.php?id_user=<?= $id_ibu ?>">Riwayat Pemeriksaan</a>
                    </li>
                    <li class="nav-item flex-fill text-center">
                        <!-- PERBAIKAN: Tambahkan id_user di URL -->
                        <a style="background: white;" class="nav-link" href="admin-tambah.php?id_user=<?= $id_ibu ?>">Tambah Riwayat Pemeriksaan</a>
                    </li>
                </ul>
            </div>

            <!-- Informasi Ibu -->
            <div class="card-body p-4 bg-light">
                <div class="text-start">
                    <h5>Informasi Pasien</h5>
                    <p class="mb-1"><strong>Nama:</strong> <?= $data_ibu['nama_user'] ?></p>
                    <p class="mb-1"><strong>NIK:</strong> <?= $data_ibu['nik'] ?></p>
                    <p class="mb-0"><strong>Alamat:</strong> <?= $data_ibu['alamat'] ?></p>
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
                                <p>Tinggi Badan</p>
                                <p>Berat Badan</p>
                                <p>Tekanan Darah</p>
                                <p>Usia Kehamilan</p>
                                <p>Tinggi Fundus</p>
                                <p>Denyut Jantung</p>
                                <p>Keluhan</p>
                                <p>Aktivitas Bayi</p>
                                <p>Tablet TTD</p>
                                <p>Catatan Dokter</p>
                            </div>
                            <div class="datanya">
                                <p><?= date('d F Y', strtotime($row['tanggal_periksa'])); ?></p>
                                <p><?= $row['tinggi_badan']; ?> cm</p>
                                <p><?= $row['berat_badan']; ?> kg</p>
                                <p><?= $row['tekanan_darah']; ?> mmHg</p>
                                <p><?= $row['usia_kehamilan']; ?> minggu</p>
                                <p><?= $row['tinggi_fundus']; ?> cm</p>
                                <p><?= $row['denyut_jantung']; ?> bpm</p>
                                <p><?= $row['keluhan']; ?></p>
                                <p><?= $row['aktivitas_bayi']; ?></p>
                                <p><?= $row['tablet_ttd']; ?></p>
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
                        <a href="admin-tambah.php?id_user=<?= $id_ibu ?>" class="btn btn-primary mt-2">Tambah Pemeriksaan Pertama</a>
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