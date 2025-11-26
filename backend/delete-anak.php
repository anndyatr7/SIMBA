<?php
session_start();
require "koneksi.php";

if(isset($_GET['id_anak'])){
    $id_user = $_SESSION['id_user'];
    $id_anak = $_GET['id_anak'];
    
    // Hapus hanya jika id_user nya sama (otoritas akun)
    $sql = "DELETE FROM data_anak WHERE id_anak=$id_anak AND id_user=$id_user";
    $result = mysqli_query($koneksi, $sql);
    
    if($result){
        header("location:../frontend/dashboard-ibu.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
    exit;
}
?>