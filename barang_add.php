<?php
include 'config.php';
session_start();

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    mysqli_query($conn, "Insert into barang values ('', '$nama', '$harga', '$jumlah')");

    $_SESSION['success'] = 'Berhasil menambahkan data';

    header("location:barang.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <h1>Tambah Barang</h1>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama barang">
            </div>
            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga barang">
            </div>
            <div class="mb-3">
                <label class="form-label">Jumlah Stok</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Stok barang">
            </div>
            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
            <a href="/kasir/barang.php" class="btn btn-warning">Kembali</a>
        </form>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>