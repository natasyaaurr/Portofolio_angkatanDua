<?php
include 'config/koneksi.php';

//jika user menekan atau mengklik tombol simpan maka perintah yang di jalankan adalah ambil data dari inputan email , nama dan password
//masukkan ke dalam table name,email,password dengan nilai dari masing masing inputan.

if (isset($_POST['simpan'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    $query = mysqli_query($config, "INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')");
    if ($query) {
        header("location:user.php?tambah=berhasil");
    }

}

$header = isset($_GET['edit']) ? "Edit" : "Tambah";
$id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM users WHERE id='$id_user'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['edit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    $queryUpdate = mysqli_query($config, "UPDATE users SET name='$name', email='$email', password='$password' WHERE id='$id_user'");
    if ($queryUpdate) {
        header("location:user.php?ubah=berhasil");
    }

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <div class="wrapper">
        <?php include 'inc/header.php' ?>
        <div class="content mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <?= $header ?> Data User
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3 row">
                                        <div class="col-sm-2">
                                            <label for="name" class="form-label">Nama *</label>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Masukkan Nama Anda" required
                                                value="<?= isset($_GET['edit']) ? $rowEdit['name'] : "" ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-2">
                                            <label for="email" class="form-label">Email *</label>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Ex:admin@gmail.com" required
                                                value="<?= isset($_GET['edit']) ? $rowEdit['email'] : "" ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-2">
                                            <label for="password" class="form-label">Password *</label>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Masukkan Password Anda" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary"
                                                name="<?= isset($_GET['edit']) ? 'edit' : 'simpan' ?>">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
</body>

</html>