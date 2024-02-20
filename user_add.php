<?php
include 'config.php';
session_start();

$role = mysqli_query($conn, "Select * from role");

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];

    mysqli_query($conn, "Insert into user values ('', '$nama', '$username', '$password', '$role_id')");

    $_SESSION['success'] = 'Berhasil menambahkan data';

    header("location:user.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <h1>Tambah User</h1>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama User">
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="text" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="mb-3">
                <label class="form-label">Role Akses</label>
                <select class="form-control" name="role_id" id="role_id">
                    <option value="">Pilih Role Akses</option>
                    <?php while ($row = mysqli_fetch_array($role)) { ?>
                        <option value="<?= $row['id_role'] ?>"><?= $row['nama'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
            <a href="/kasir/user.php" class="btn btn-warning">Kembali</a>
        </form>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>