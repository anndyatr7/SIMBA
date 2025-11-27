<?php 
session_start();
require "koneksi.php";

if(isset($_POST['regis'])){
    // PERBAIKAN: Nama variabel sesuai dengan name di form
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $password = mysqli_real_escape_string($koneksi, $_POST["password"]);
    $nik = mysqli_real_escape_string($koneksi, $_POST["nik"]);
    $email = mysqli_real_escape_string($koneksi, $_POST["email"]);
    $noHP = mysqli_real_escape_string($koneksi, $_POST["no_hp"]);
    $goldar = mysqli_real_escape_string($koneksi, $_POST["goldar"]);
    $gender = mysqli_real_escape_string($koneksi, $_POST["gender"]);
    $tempatLahir = mysqli_real_escape_string($koneksi, $_POST["tempat_lahir"]);
    $tanggalLahir = mysqli_real_escape_string($koneksi, $_POST["tanggal_lahir"]);
    $alamat = mysqli_real_escape_string($koneksi, $_POST["alamat"]);

    // Cek apakah NIK sudah ada
    $check = "SELECT id_user FROM user WHERE nik = '$nik'";
    $check_result = mysqli_query($koneksi, $check);
    
    if(mysqli_num_rows($check_result) > 0){
        echo "<script>
                alert('NIK sudah terdaftar!');
                window.location.href = '../frontend/registrasi.php';
              </script>";
        exit;
    }
    
    // PERBAIKAN: Nama tabel dari 'peserta' menjadi 'user'
    // PERBAIKAN: Sintaks SQL yang benar (hilangkan $id_user, itu auto increment)
    // PERBAIKAN: Quote yang benar di VALUES
    $query = "INSERT INTO user (nama_user, nik, email, password, no_hp, goldar, gender, tempat_lahir, ttl, alamat) 
              VALUES ('$nama', '$nik', '$email', '$password', '$noHP', '$goldar', '$gender', '$tempatLahir', '$tanggalLahir', '$alamat')";
    
    $result = mysqli_query($koneksi, $query);
    
    if($result){
        echo "<script>
                alert('Registrasi berhasil! Silakan login.');
                window.location.href = '../frontend/homepage.php';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('Error: " . mysqli_error($koneksi) . "');
                window.location.href = '../frontend/registrasi.php';
              </script>";
        exit;
    }
}
?>