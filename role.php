<?php
include 'config.php';
session_start();

$view = $conn->query("Select * from role");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Role</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <?php if (isset($_SESSION['success']) && $_SESSION['success'] != '') { ?>

            <div class="alert alert-success" role="alert">
                <?= $_SESSION['success'] ?>
            </div>

        <?php }
        $_SESSION['success'] = '' ?>


        <h1 class="mt-3 mb-3">List Role</h1>
        <a href="/kasir/index.php" class="btn btn-warning g-4"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
        <a href="/kasir/role_add.php" class="btn btn-primary">Tambah data</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID Role</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>

            <?php
            while ($row = $view->fetch_array()) {
            ?>

                <tbody>
                    <tr>
                        <th scope="row"><?= $row['id_role'] ?></th>
                        <td><?= $row['nama'] ?></td>
                        <td>
                            <a href="/kasir/role_edit.php?id=<?= $row['id_role'] ?>" class="btn btn-warning">Edit</a>
                            <a href="/kasir/role_hapus.php?id=<?= $row['id_role'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</a>
                        </td>
                    </tr>
                </tbody>

            <?php } ?>
        </table>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>