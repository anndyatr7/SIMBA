<?php 
session_start();
require "koneksi.php";

if(isset($_POST['formanak'])){
    // PERBAIKAN: Nama variabel sesuai dengan name di form
    $id_user = $_SESSION['id_user'];
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $nik = mysqli_real_escape_string($koneksi, $_POST["nik"]);
    $goldar = mysqli_real_escape_string($koneksi, $_POST["goldar"]);
    $gender = mysqli_real_escape_string($koneksi, $_POST["gender"]);
    $tempatLahir = mysqli_real_escape_string($koneksi, $_POST["tempat_lahir"]);
    $tanggalLahir = mysqli_real_escape_string($koneksi, $_POST["tanggal_lahir"]);

    // Cek apakah NIK ada di user ATAU data_anak
    $check = "SELECT 1 FROM user WHERE nik = ? 
            UNION ALL 
            SELECT 1 FROM data_anak WHERE nik = ? 
            LIMIT 1";

    $check_stmt = mysqli_prepare($koneksi, $check);
    mysqli_stmt_bind_param($check_stmt, "ss", $nik, $nik);
    mysqli_stmt_execute($check_stmt);
    $check_result = mysqli_stmt_get_result($check_stmt);

    if(mysqli_num_rows($check_result) > 0){
        echo "<script>
                alert('NIK sudah terdaftar di sistem!');
                window.location.href = '../frontend/form-anak.php';
            </script>";
        exit;
    }
    
    // PERBAIKAN: Nama tabel dari 'peserta' menjadi 'user'
    // PERBAIKAN: Sintaks SQL yang benar (hilangkan $id_user, itu auto increment)
    // PERBAIKAN: Quote yang benar di VALUES
    $query = "INSERT INTO data_anak (id_user, nama_anak, nik, tempat_lahir, tanggal_lahir, gender, goldar) 
              VALUES ($id_user, '$nama', '$nik', '$tempatLahir', '$tanggalLahir', '$gender',  '$goldar')";
    
    $result = mysqli_query($koneksi, $query);
    
    if($result){
        // CEK DARI MANA USER BERASAL (referer)
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        
        // Jika dari pilih-anak.php, kembali ke sana
        if(strpos($referer, 'pilih-anak.php') !== false){
            echo "<script>
                    alert('Berhasil menambahkan data anak!');
                    window.location.href = '../frontend/pilih-anak.php';
                  </script>";
        } else {
            // Jika dari dashboard-ibu.php atau tempat lain
            echo "<script>
                    alert('Berhasil menambahkan data anak!');
                    window.location.href = '../frontend/dashboard-ibu.php';
                  </script>";
        }
        exit;
    } else {
        echo "<script>
                alert('Error: " . mysqli_error($koneksi) . "');
                window.location.href = '../frontend/form-anak.php';
              </script>";
        exit;
    }
}
?>