<?php
if(!isset($_SESSION['username'])){
    header("location:login.php?status=login_dulu");
}
