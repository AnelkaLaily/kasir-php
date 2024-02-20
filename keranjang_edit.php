<?php
include 'config.php';
include 'authcheck_kasir.php';
session_start();

$qty =$_POST['qty'];

foreach ($_SESSION['cart'] as $key => $value) {
    $_SESSION['cart'][$key]['qty'] = $qty[$key];
}

header("location:kasir.php");
?>