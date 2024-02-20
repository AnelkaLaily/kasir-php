<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    mysqli_query($conn, "Delete from role where id_role='$id'");

    $_SESSION['success'] = 'Berhasil menghapus data';

    header("location:role.php");
}
?>