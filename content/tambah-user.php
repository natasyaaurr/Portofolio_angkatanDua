<?php
if ($_SESSION['LEVEL'] != 1) {
    //    echo "<h1>Access Denied</h1>";
//     echo "<p>You do not have permission to view this page.</p>";
//     echo "<a href='dashboard.php' class='btn btn-warning' >Go back to home</a>";
//     die;
    header("location:dashboard.php?failed=access");
}

if (isset($_POST['simpan'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $id_level = $_POST['id_level'];
    $password = sha1($_POST['password']);

    $query = mysqli_query($config, "INSERT INTO users (name,email,password,id_level) VALUES ('$name','$email','$password', '$id_level')");
    if ($query) {
        header("location:?page=user&tambah=berhasil");
    }

}

$header = isset($_GET['edit']) ? "Edit" : "Tambah";
$id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM users WHERE id='$id_user'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['edit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $id_level = $_POST['id_level'];
    $password = sha1($_POST['password']);

    $queryUpdate = mysqli_query($config, "UPDATE users SET name='$name', email='$email', password='$password', id_level = $id_level WHERE id='$id_user'");
    if ($queryUpdate) {
        header("location:?page=user&ubah=berhasil");
    }

}

$queryLevel = mysqli_query($config, "SELECT * FROM levels ORDER BY id DESC");
$rowLevel = mysqli_fetch_all($queryLevel, MYSQLI_ASSOC); {
    // $selected = isset($_GET['edit']) && $rowEdit['id_level'] == $rowLevel['id'] ? 'selected' : '';
// echo "<option value='{$rowLevel['id']}' $selected>{$rowLevel['name_level']}</option>";
}
?>



<form action="" method="post">

    <div class="mb-3 row">
        <div class="col-sm-2">
            <label for="" class="form-label">Nama level</label>
        </div>
        <div class="col-sm-10">
            <select class="form-select" name="id_level" id="id_level" required>
                <option value="">Pilih Level</option>
                <?php foreach ($rowLevel as $level): ?>
                    <option <?php echo isset($_GET['edit']) ? ($level['id'] == $rowEdit['id_level']) ? 'selected' : '' : '' ?>value="<?php echo $level['id'] ?>"><?php echo $level['name_level'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-2">
            <label for="name" class="form-label">Nama *</label>
        </div>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Anda" required
                value="<?= isset($_GET['edit']) ? $rowEdit['name'] : "" ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-2">
            <label for="email" class="form-label">Email *</label>
        </div>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="Ex:admin@gmail.com" required
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