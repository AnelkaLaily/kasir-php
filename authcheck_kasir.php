<?php

if (isset($_SESSION['userid'])) {
    if ($_SESSION['role_id'] == 1) {
        header("location:index.php");
    }
} else {
    $_SESSION['error'] = 'Anda harus login terlebih dahulu!';
    header("location:login.php");
}
