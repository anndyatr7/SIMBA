<?php
require "koneksi.php";
session_start();

$sql = "SELECT * FROM user WHERE nik='$nik' AND password='$password'";
$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) > 0){
    $data = mysqli_fetch_assoc($result);
    $_SESSION['nik'] = $data['nik'];
    $_SESSION['id_user'] = $data['id_user'];

    // CEK APAKAH USER INI ADA DI TABEL data_anak
    $id = $data['id_user'];
    $cek_anak = mysqli_query($koneksi, "SELECT * FROM data_anak WHERE id_user='$id'");

    if(mysqli_num_rows($cek_anak) > 0){
        // Kalau ada → berarti user ini masuk sebagai IBU ANAK
        header("Location: ../frontend/dashboard-anak.php");
        exit;
    } else {
        // Kalau tidak ada → user ini adalah IBU (orang dewasa)
        header("Location: ../frontend/dashboard-ibu.php");
        exit;
    }
}
 
// ========================================
// REGISTER USER
// ========================================
if(isset($_POST['regis'])){
    // PERBAIKAN: Sesuaikan dengan name di form registrasi.php
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
    
    // Cek apakah NIK sudah terdaftar
    $check = $koneksi->prepare("SELECT id_user FROM user WHERE nik = ?");
    $check->bind_param("s", $nik);
    $check->execute();
    $check->store_result();

    if($check->num_rows > 0){
        echo "<script>
                alert('NIK sudah terdaftar!');
                window.location.href = '../frontend/registrasi.php';
              </script>";
        exit;
    } else {
        // PERBAIKAN: Urutan kolom sesuai database
        $stmt = $koneksi->prepare("INSERT INTO user (nama_user, nik, email, password, no_hp, goldar, gender, tempat_lahir, ttl, alamat) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $nama, $nik, $email, $password, $noHP, $goldar, $gender, $tempatLahir, $tanggalLahir, $alamat);

        if($stmt->execute()){
            echo "<script>
                    alert('Registrasi berhasil! Silakan login.');
                    window.location.href = '../frontend/homepage.php';
                  </script>";
            exit;
        } else {
            echo "<script>
                    alert('Terjadi kesalahan: " . $stmt->error . "');
                    window.location.href = '../frontend/registrasi.php';
                  </script>";
            exit;
        }
        $stmt->close();
    }
    $check->close();
}

// ========================================
// LOGIN ADMIN
// ========================================
if(isset($_POST['loginAdmin'])){
    $nip = mysqli_real_escape_string($koneksi, $_POST['NIP']);
    $passwordAdmin = mysqli_real_escape_string($koneksi, $_POST['passwordAdmin']);

    // PERBAIKAN: Logika if dibalik (sebelumnya salah)
    if($nip == '12345' && $passwordAdmin == 'Admin123'){
        $_SESSION['admin'] = true;
        $_SESSION['nip'] = $nip;
        header("location:../frontend/admin-dashboard-ibu.php");
        exit;
    } else {
        echo "<script>
                alert('NIP atau Password Admin salah!');
                window.location.href = '../frontend/homepage.php';
              </script>";
        exit;
    }
}
?>