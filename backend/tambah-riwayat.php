<?php
session_start();
require "koneksi.php";

// Cek apakah admin sudah login
if(!isset($_SESSION['admin'])){
    header("location: ../frontend/homepage.php");
    exit;
}

if(isset($_POST['tambah_riwayat'])){
    // Ambil data dari form
    $id_user = mysqli_real_escape_string($koneksi, $_POST['id_user']);
    $tinggi_badan = mysqli_real_escape_string($koneksi, $_POST['tinggi_badan']);
    $berat_badan = mysqli_real_escape_string($koneksi, $_POST['berat_badan']);
    $tekanan_darah = mysqli_real_escape_string($koneksi, $_POST['tekanan_darah']);
    $usia_kehamilan = mysqli_real_escape_string($koneksi, $_POST['usia_kehamilan']);
    $tinggi_fundus = mysqli_real_escape_string($koneksi, $_POST['tinggi_fundus']);
    $denyut_jantung = mysqli_real_escape_string($koneksi, $_POST['denyut_jantung']);
    $keluhan = mysqli_real_escape_string($koneksi, $_POST['keluhan']);
    $aktivitas_bayi = mysqli_real_escape_string($koneksi, $_POST['aktivitas_bayi']);
    $tablet_ttd = mysqli_real_escape_string($koneksi, $_POST['tablet_ttd']);
    $catatan_dokter = mysqli_real_escape_string($koneksi, $_POST['catatan_dokter']);
    $tanggal_periksa = date('Y-m-d'); // Tanggal hari ini
    
    // insert ke database
    $query = "INSERT INTO riwayat_pemeriksaan 
              (tinggi_badan, berat_badan, tekanan_darah, 
               usia_kehamilan, tinggi_fundus, denyut_jantung, keluhan, 
               aktivitas_bayi, tablet_ttd, catatan_dokter, id_user, tanggal_periksa) 
              VALUES 
              ('$tinggi_badan', '$berat_badan', '$tekanan_darah', 
               '$usia_kehamilan', '$tinggi_fundus', '$denyut_jantung', '$keluhan', 
               '$aktivitas_bayi', '$tablet_ttd', '$catatan_dokter', '$id_user',  '$tanggal_periksa')";
    
    $result = mysqli_query($koneksi, $query);
    
    if($result){
        echo "<script>
                alert('Riwayat pemeriksaan berhasil ditambahkan!');
                window.location.href = '../frontend/admin-riwayat.php?id_user={$id_user}';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . mysqli_error($koneksi) . "');
                window.location.href = '../frontend/admin-tambah.php';
              </script>";
    }
    exit;
}
?>