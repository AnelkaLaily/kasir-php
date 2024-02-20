<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $data = mysqli_query($conn, "Select * from role where id_role='$id'");
    $data = mysqli_fetch_assoc($data);
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $nama = $_POST['nama'];

    mysqli_query($conn, "Update role set nama='$nama' where id_role='$id'");

    header("location:role.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Role</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <h1>Edit Role</h1>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Role" value="<?= $data['nama'] ?>">
            </div>
            <input type="submit" name="update" value="Perbarui" class="btn btn-primary">
            <a href="/kasir/role.php" class="btn btn-warning">Kembali</a>
        </form>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>