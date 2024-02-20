<?php
session_start();
include 'config.php';
include 'authcheck_kasir.php';

$barang = mysqli_query($conn, "Select * from barang");

if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$sum = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        $sum += $value['harga'] * $value['qty'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1>Kasir</h1>
                <h3>Selamat Datang, <?= $_SESSION['nama'] ?>!</h3>
                <a href="/kasir/logout.php">Logout</a>
                <a href="/kasir/reset_keranjang.php">Reset Keranjang</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-8">
                <form method="POST" action="keranjang_act.php">
                    <div class="input-group mb-3">
                        <select class="form-select" name="id_barang">
                            <option selected>Pilih Barang</option>
                            <?php while ($row = mysqli_fetch_array($barang)) { ?>
                                <option value="<?= $row['id_barang'] ?>"><?= $row['nama'] ?></option>
                            <?php } ?>
                        </select>
                        <input type="number" name="qty" id="qty" class="from-control" placeholder="Jumlah">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
                <br>
                <form method="POST" action="/kasir/keranjang_edit.php">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col" style="text-align: center;">Harga</th>
                                <th scope="col" style="text-align: center;">Qty</th>
                                <th scope="col" style="text-align: center;">Sub Total</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                                <tr>
                                    <th scope="row"><?= $value['nama'] ?></th>
                                    <td align="right"><?= number_format($value['harga']) ?></td>
                                    <td align="center" class="col-sm-2"><input type="number" name="qty[]" id="qty[]" class="form-control" value="<?= $value['qty'] ?>"></td>
                                    <td align="right"><?= number_format($value['qty'] * $value['harga']) ?></td>
                                    <td align="center"><a href="/kasir/keranjang_hapus.php?id=<?= $value['id'] ?>" class="btn btn-danger">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <button class="btn btn-info" type="submit">Perbarui</button>
                </form>
            </div>
            <div class="col-md-4">
                <h3>Total Rp <?= number_format($sum) ?></h3>
                <form action="/kasir/transaksi_act.php" method="POST">
                    <input type="hidden" name="total" id="total" value="<?= $sum ?>">
                    <div class="form-group">
                        <label for="">Bayar</label>
                        <input type="text" name="bayar" id="bayar" class="form-control">
                    </div>
                    <button class="btn btn-success" type="submit">Selesai</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    var bayar = document.getElementById('bayar');

    bayar.addEventListener('keyup', function(e) {
        bayar.value = formatRupiah(this.value, 'Rp ');

    });

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
    }

    function cleanRupiah(rupiah) {
        var clean = rupiah.replace(/\D/g, '');
        return clean;
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>