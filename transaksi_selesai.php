<?php
include 'config.php';
session_start();
include "authcheck_kasir.php";

$id_trx = $_GET['idtrx'];

$data = mysqli_query($conn, "Select * from transaksi where id_transaksi='$id_trx'");
$trx = mysqli_fetch_assoc($data);

$detail = mysqli_query($conn, "SELECT transaksi_detail.*, barang.nama FROM transaksi_detail INNER JOIN barang on transaksi_detail.id_barang=barang.id_barang WHERE transaksi_detail.id_transaksi='$id_trx'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Selesai</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            color: #a7a7a7;
        }
    </style>
</head>

<body>
    <div align="center">
        <table width="500" border="0" cellpadding="1" cellspacing="0">
            <tr align="center">
                <th>Toko Sport <br> Jl Tamtaman IV Baluwarti Pasar Kliwon <br> Surakarta, Jawa Tengah, 57114</th>
            </tr>
            <tr align="center">
                <td>
                    <hr>
                </td>
            </tr>
            <tr>
                <td>#<?= $trx['nomor'] ?> | <?= date('d-m-Y H:i:s', strtotime($trx['tanggal_waktu'])) ?> <?= $trx['nama'] ?></td>
            </tr>
            <tr>
                <td>
                    <hr>
                </td>
            </tr>
        </table>
        <table width="500" border="0" cellpadding="3" cellspacing="0">
            <?php while ($row = mysqli_fetch_array($detail)) { ?>
                <tr>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['qty'] ?></td>
                    <td align="right"><?= number_format($row['harga']) ?></td>
                    <td align="right"><?= number_format($row['total']) ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="4">
                    <hr>
                </td>
            </tr>
            <tr>
                <td align="right" colspan="3">Total</td>
                <td align="right"><?= number_format($trx['total']) ?></td>
            </tr>
            <tr>
                <td align="right" colspan="3">Bayar</td>
                <td align="right"><?= number_format($trx['bayar']) ?></td>
            </tr>
            <tr>
                <td align="right" colspan="3">Kembali</td>
                <td align="right"><?= number_format($trx['kembali']) ?></td>
            </tr>
        </table>
        <table width="500" border="0" cellpadding="1" cellspacing="0" style="text-align: center;">
            <tr>
                <td>
                    <hr>
                </td>
            </tr>
            <tr>
                <th>Terimakasih, Selamat Belanja Kembali</th>
            </tr>
            <tr>
                <th>===== Layanan Konsumen =====</th>
            </tr>
            <tr>
                <th>SMS/CALL 089517980301</th>
            </tr>
        </table>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>