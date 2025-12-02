<?php
session_start();
require "koneksi.php";

// Cek apakah admin sudah login
if(!isset($_SESSION['admin'])){
    header("location: ../frontend/homepage.php");
    exit;
}

if(isset($_POST['tambah_riwayat_anak'])){
    $id_anak = mysqli_real_escape_string($koneksi, $_POST['id_anak']);
    $usia_bulan = mysqli_real_escape_string($koneksi, $_POST['usia_bulan']);
    $berat_badan = mysqli_real_escape_string($koneksi, $_POST['bb']);
    $tinggi_badan = mysqli_real_escape_string($koneksi, $_POST['tb']);
    $lingkar_kepala = mysqli_real_escape_string($koneksi, $_POST['lingkar_kepala']);
    $lingkar_lengan = mysqli_real_escape_string($koneksi, $_POST['lingkar_lengan']);
    $status_gizi = mysqli_real_escape_string($koneksi, $_POST['status_gizi']);
    $vitamin = mysqli_real_escape_string($koneksi, $_POST['vitamin']);
    $imunisasi = mysqli_real_escape_string($koneksi, $_POST['imunisasi']);
    $keluhan = mysqli_real_escape_string($koneksi, $_POST['keluhan']);
    $diagnosis = mysqli_real_escape_string($koneksi, $_POST['diagnosis']);
    $catatan_dokter = mysqli_real_escape_string($koneksi, $_POST['catatan_dokter']);
    $tanggal_periksa = date('Y-m-d');
    
    $query = "INSERT INTO riwayat_pemeriksaan_anak 
              (id_anak, tanggal_periksa, usia_bulan, berat_badan, tinggi_badan, 
               lingkar_kepala, lingkar_lengan, status_gizi, imunisasi, vitamin, 
               keluhan, diagnosis, catatan_dokter) 
              VALUES 
              ('$id_anak', '$tanggal_periksa', '$usia_bulan', '$berat_badan', '$tinggi_badan', 
               '$lingkar_kepala', '$lingkar_lengan', '$status_gizi', '$imunisasi', '$vitamin', 
               '$keluhan', '$diagnosis', '$catatan_dokter')";
    
    $result = mysqli_query($koneksi, $query);
    
    if($result){
        echo "<script>
                alert('Riwayat pemeriksaan anak berhasil ditambahkan!');
                window.location.href = '../frontend/admin-riwayat-anak.php?id_anak=$id_anak';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . mysqli_error($koneksi) . "');
                window.location.href = '../frontend/admin-tambah-anak.php?id_anak=$id_anak';
              </script>";
    }
    exit;
}
?>