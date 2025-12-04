<?php 
require "koneksi.php";
$id_anak = $_GET['id_anak'];

$query = "DELETE FROM data_anak WHERE id_anak='$id_anak'";
$result = mysqli_query($koneksi, $query);

if($result){
    echo "<script>
    alert('User berhasil dihapus');
    window.location.href = '../frontend/admin-dashboard-anak.php';
        </script>";
} else{
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

?>