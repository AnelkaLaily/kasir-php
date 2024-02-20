<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    mysqli_query($conn, "Delete from user where id_user='$id'");

    $_SESSION['success'] = 'Berhasil menghapus data';

    header("location:user.php");
}
