<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    mysqli_query($conn, "Delete from barang where id_barang='$id'");

    $_SESSION['success'] = 'Berhasil menghapus data';

    header("location:barang.php");
}
?>