<?php
// KODE KAMU
require "koneksi.php";
session_start();
// Untuk Login
// KODE KAMU
if(isset($_POST['login'])){
    $nik = $_POST['nik'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE nik='$nik' AND password='$pass'";
    $result = mysqli_query($koneksi,$sql);

    if (mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_assoc($result);
        $_SESSION['nik'] = $data['nik'];
        $_SESSION['id_user'] = $data['id_user'];

        header('location:../dashboard-ibu.php');
        exit;
    }
}
 
// Untuk Register
// KODE KAMU
if(isset($_POST['regis'])){
    $nama = $_POST["nama_user"];
    $password = $_POST["pass"];
    $nik = $_POST["nik"];
    $email = $_POST["email"];
    $noHP = $_POST["no_hp"];
    $goldar = $_POST["goldar"];
    $gender = $_POST["gender"];
    $tempatLahir = $_POST["tempat_lahir"];
    $tanggalLahir = $_POST["tanggal_lahir"];
    $alamat = $_POST["alamat"];
    
    $check = $koneksi->prepare("SELECT id_user FROM user WHERE nik = ?");
    $check->bind_param("s", $nik);
    $check->execute();
    $check->store_result();

    if($check->num_rows > 0){
        echo "<script>alert('nik sudah ada!');
                window.location.href = '../frontend/register.php';
            </script>";
    } else {
        $stmt = $koneksi->prepare("INSERT INTO user (nama_user, goldar, no_hp, tempat_lahir, ttl, alamat, email, password, gender, nik) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssdsssss", $nama, $goldar, $noHP, $tempatLahir, $tanggalLahir, $alamat, $email, $password, $gender, $nik);

        if($stmt->execute()){
            header("Location:../index.php");
            exit;
        } else {
            echo "terjadi kesalahan saat registrasi.";
        }
        $stmt->close();
    }
    $check->close();
}

//BUAT ADMIN
if(isset($_POST['loginAdmin'])){
    $nip = $_POST['NIP'];
    $passwordAdmin = $_POST['passwordAdmin'];

    if($nip != '12345' && $passwordAdmin != 'Admin123'){
        header("location:../frontend/homepage.php");
    } else{
        header("location:../frontend/admin-dashboard-ibu.php");
    }
    exit;
}
?>