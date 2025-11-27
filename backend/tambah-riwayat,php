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
    $tinggi_badan = mysqli_real_escape_string($koneksi, $_POST['tb']);
    $berat_badan = mysqli_real_escape_string($koneksi, $_POST['bb']);
    $tekanan_darah = mysqli_real_escape_string($koneksi, $_POST['tenxi']);
    $usia_kehamilan = mysqli_real_escape_string($koneksi, $_POST['usiahamil']);
    $tinggi_fundus = mysqli_real_escape_string($koneksi, $_POST['fundus']);
    $denyut_jantung = mysqli_real_escape_string($koneksi, $_POST['denyut']);
    $keluhan = mysqli_real_escape_string($koneksi, $_POST['keluhan']);
    $aktivitas_bayi = mysqli_real_escape_string($koneksi, $_POST['aktifitas']);
    $tablet_ttd = mysqli_real_escape_string($koneksi, $_POST['ttd']);
    $catatan_dokter = mysqli_real_escape_string($koneksi, $_POST['alasan']);
    $tanggal_periksa = date('Y-m-d'); // Tanggal hari ini
    
    // Query INSERT ke database
    $query = "INSERT INTO riwayat_pemeriksaan 
              (id_user, tanggal_periksa, tinggi_badan, berat_badan, tekanan_darah, 
               usia_kehamilan, tinggi_fundus, denyut_jantung, keluhan, 
               aktivitas_bayi, tablet_ttd, catatan_dokter) 
              VALUES 
              ('$id_user', '$tanggal_periksa', '$tinggi_badan', '$berat_badan', '$tekanan_darah', 
               '$usia_kehamilan', '$tinggi_fundus', '$denyut_jantung', '$keluhan', 
               '$aktivitas_bayi', '$tablet_ttd', '$catatan_dokter')";
    
    $result = mysqli_query($koneksi, $query);
    
    if($result){
        echo "<script>
                alert('Riwayat pemeriksaan berhasil ditambahkan!');
                window.location.href = '../frontend/admin-riwayat.php';
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