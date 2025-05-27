<?php
session_start();
include 'config/koneksi.php';

if (isset($_POST['email']) && ($_POST['password'])) {
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    //select atau tampilkan semua data dari table user dimana email dan password di ambil dari orang 
    // input di inputan email

    $query = mysqli_query($config, "SELECT * FROM users WHERE email='$email' AND password='$password' ");

    //apakah betul email dan password yang di input user adalah email yang ada di table user
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $_SESSION['NAME'] = $row['name'];
        $_SESSION['ID_USER'] = $row['id'];
        $_SESSION['LEVEL'] = $row['id_level'];
        header("location:dashboard.php");
    } else {
        header("location:index.php?error=login");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form | Portofolio Natasyah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <div class="wrapper">
        <div class="login-form mt-5">
            <div class="container">
                <div class="row  justify-content-center">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header"> Login Form</div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Ex:admin@gmail.com" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Masukkan Password Anda.." required>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary" name="login">Login</button>
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