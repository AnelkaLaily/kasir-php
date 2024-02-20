<?php
include 'config.php';
session_start();

if (isset($_POST['masuk'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "Select * from user where username='$username' and password='$password'");

    $data = mysqli_fetch_array($query);

    $check = mysqli_num_rows($query);

    if (!$check) {
        $_SESSION['error'] = 'Username & password salah';
    } else {
        $_SESSION['userid'] = $data['id_user'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role_id'] = $data['role_id'];

        header("location:index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <?php if (isset($_SESSION['error']) && $_SESSION['error'] != '') { ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['error'] ?>
            </div>
        <?php }
        $_SESSION['error'] = ''; ?>
        <h1>Login</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <input type="submit" name="masuk" id="masuk" value="Masuk" class="btn btn-default">
        </form>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>