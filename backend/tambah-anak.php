<?php
session_start();
require "koneksi.php";

// Cek apakah user sudah login
if(!isset($_SESSION['id_user'])){
    header("location: ../frontend/homepage.php");
    exit;
}

if(isset($_POST['tambah_anak'])){
    $id_user = $_SESSION['id_user'];
    $nama_anak = mysqli_real_escape_string($koneksi, $_POST['nama_anak']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $golongan_darah = mysqli_real_escape_string($koneksi, $_POST['golongan_darah']);
    $berat_lahir = mysqli_real_escape_string($koneksi, $_POST['berat_lahir']);
    $tinggi_lahir = mysqli_real_escape_string($koneksi, $_POST['tinggi_lahir']);
    
    $query = "INSERT INTO data_anak (id_user, nama_anak, tanggal_lahir, jenis_kelamin, golongan_darah, berat_lahir, tinggi_lahir) 
              VALUES ('$id_user', '$nama_anak', '$tanggal_lahir', '$jenis_kelamin', '$golongan_darah', '$berat_lahir', '$tinggi_lahir')";
    
    $result = mysqli_query($koneksi, $query);
    
    if($result){
        echo "<script>
                alert('Data anak berhasil ditambahkan!');
                window.location.href = '../frontend/dashboard-ibu.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . mysqli_error($koneksi) . "');
                window.location.href = '../frontend/dashboard-ibu.php';
              </script>";
    }
    exit;
}
?>