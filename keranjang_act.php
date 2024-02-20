<?php
session_start();
include 'config.php';
include 'authcheck_kasir.php';

if (isset($_POST['id_barang'])) {
    $id_barang = $_POST['id_barang'];
    $qty = $_POST['qty'];

    $data = mysqli_query($conn, "Select * from barang where id_barang='$id_barang'");
    $b = mysqli_fetch_assoc($data);

    $barang = [
        'id' => $b['id_barang'],
        'nama' => $b['nama'],
        'harga' => $b['harga'],
        'qty' => $qty,
    ];

    $_SESSION['cart'][] = $barang;
    krsort($_SESSION['cart']);

    header("location:kasir.php");
}
?>