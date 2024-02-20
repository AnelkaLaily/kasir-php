<?php
include 'config.php';

$role = mysqli_query($conn, "Select * from role");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $data = mysqli_query($conn, "Select * from user where id_user='$id'");
    $data = mysqli_fetch_assoc($data);
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];

    mysqli_query($conn, "Update user set nama='$nama', username='$username', password='$password', role_id='$role_id' where id_user='$id'");

    header("location:user.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <h1>Edit User</h1>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?= $data['nama'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= $data['username'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="text" class="form-control" id="password" name="password" placeholder="Password" value="<?= $data['password'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Role Akses</label>
                <select class="form-control" name="role_id" id="role_id">
                    <option value="">Pilih Role Akses</option>
                    <?php while ($row = mysqli_fetch_array($role)) { ?>
                        <option value="<?= $row['id_role'] ?>" <?= $row['id_role'] == $data['role_id'] ? 'selected' : '' ?>><?= $row['nama'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <input type="submit" name="update" value="Perbarui" class="btn btn-primary">
            <a href="/kasir/user.php" class="btn btn-warning">Kembali</a>
        </form>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>