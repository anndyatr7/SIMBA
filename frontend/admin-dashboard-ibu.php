<?php 
require "../backend/koneksi.php";

$query = "SELECT * FROM user ORDER BY id_user DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<he>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Admin Ibu</title>
    <style>
         body{
            margin-top: 90px;
        }
        .card-header {
            padding: 0 !important;
        }
        .card{
             min-height: 100vh;
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
    <link rel="stylesheet" href="styling/buatadmin.css?v<?php echo time();?>">

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
            <a href="../backend/logout.php">LogOut</a>
        </div>
    </nav>
    <!-- NavBar End -->

    <div class="container mt-4 mb-4">
        <div class="card text-center mx-auto shadow rounded" style="width: 100%">

            <div class="card-header p-0">
                <ul class="nav nav-tabs w-100 d-flex justify-content-center">
                    <li class="nav-item flex-fill text-center">
                        <a class="nav-link active" href="admin-dashboard-ibu.php">Ibu Hamil</a>
                    </li>
                    <li class="nav-item flex-fill text-center">
                        <a class="nav-link" href="admin-dashboard-anak.php">Anak-Anak</a>
                    </li>
                </ul>
            </div>

            <?php 
            $no = 1;
            while($row = mysqli_fetch_assoc($result)){
            ?>
            <div class="loop-data">
                <p class="card-text"><?= $no++; ?></p>
                <p class="card-text"><?= $row['nama_user'] ?></p>
                <p class="card-text"><?= $row['alamat'] ?></p>
                <a href="admin-riwayat.php?id_user=<?= $row['id_user'] ?>">
                    Lihat Riwayat
                </a>
            </div>
            <?php }?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>
</html>