<?php 
session_start();
require "koneksi.php";

if(isset($_POST['nama'])){
    $nama = $_POST["nama_user"];
    $password = $_POST["pass"];
    $nik = $_POST["nik"];
    $email = $_POST["email"];
    $noHP = $_POST["no_hp"];
    switch($_POST["goldar"]){
        case "A" :
            $goldar = "A";
            break;
        case "B" :
            $goldar = "B";
            break;
        case "AB" :
            $goldar = "AB";
            break;
        case "O" :
            $goldar = "O";
            break;
    }
    switch($_POST["gender"]){
        case "1" :
            $gender = "Perempuan";
            break;
        case "2" :
            $gender = "Laki-laki";
            break;
    }
    $tempatLahir = $_POST["tempat_lahir"];
    $tanggalLahir = $_POST["tanggal_lahir"];
    $alamat = $_POST["alamat"];

    $query = "INSERT INTO peserta (id_user, nama_user, goldar, no_hp, tempat_lahir, ttl, alamat, email, password,gender,nik) 
              VALUES ($id_user, '$nama', '$goldar', '$no_hp','$tempatLahir', $tanggalLahir, '$email','$password','$gender,'$nik'')";
    
    $result = mysqli_query($koneksi, $query);
    
    if($result){
        header("location: ../index.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
    exit;
}
?>