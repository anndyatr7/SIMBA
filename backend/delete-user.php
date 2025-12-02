<?php 
require "koneksi.php";
$id_user = $_GET['id_user'];

$query = "DELETE FROM user WHERE id_user='$id_user'";
$result = mysqli_query($koneksi, $query);

if($result){
    echo "<script>
    alert('User berhasil dihapus');
    window.location.href = '../frontend/admin-dashboard-ibu.php';
        </script>";
} else{
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

?>