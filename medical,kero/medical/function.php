<?php 

function check_login(){
if (empty($_SESSION['pharmacies'])) {
    header("location:login.php");
    exit;
}
}
?>