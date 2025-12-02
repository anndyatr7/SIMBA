<?php
session_start();
require "config/koneksi.php";

//pemantauan keluhan
//====================
$id_user = $_SESSION["id_user"];
$minggu = $_POST['minggu_ke'];
$keluhan = $_POST['keluhan'] ?? [];

// Simpan keluhan satu per satu ke tabel pantauan
foreach ($keluhan as $id_keluhan) {
    mysqli_query($konek, "
        INSERT INTO pantauan (id_keluhan, id_user, minggu_ke, status, tgl_input)
        VALUES ('$id_keluhan', '$id_user', '$minggu', 1, NOW())
    ");
}

header("Location: pantau.php?saved=1");
exit;

// pemantauan ttd
//=================
$id_user = $_SESSION['id_user'];
$bulan   = $_POST['bulan'];
$hari    = $_POST['hari'];
$status  = isset($_POST['status']) ? 1 : 0;

mysqli_query($koneksi, "
    INSERT INTO pantauan_ttd (bulan, hari, status, id_user)
    VALUES ('$bulan', '$hari', '$status', '$id_user')
");

header("Location: pemantauan-ibu.php?ttd_saved=1");
exit;

