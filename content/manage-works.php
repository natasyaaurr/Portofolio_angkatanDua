<?php
if ($_SESSION['LEVEL'] != 1) {
    //    echo "<h1>Access Denied</h1>";
//     echo "<p>You do not have permission to view this page.</p>";
//     echo "<a href='dashboard.php' class='btn btn-warning' >Go back to home</a>";
//     die;
    header("location:?page=works&failed=access");
}

if (isset($_POST['simpan'])) {
    $title = $_POST['title'];
    $categories = $_POST['email'];
    $photo = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    $fileName = uniqid() . "_" . basename($photo);
    $filePath = "uploads/" . $fileName;

    $queryWorks = mysqli_query($config, "INSERT INTO works (title,categories,photo) VALUES ('$title','$categories','$fileName')");
    if ($query) {
        header("location:?page=works&tambah=berhasil");
    }

}

$header = isset($_GET['edit']) ? "Edit" : "Tambah";
$id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM works WHERE id='$id_user'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['edit'])) {
    $title = $_POST['title'];
    $categories = $_POST['email'];
    $photo = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    $fileName = uniqid() . "_" . basename($photo);
    $filePath = "uploads/" . $fileName;

    $queryUpdate = mysqli_query($config, "UPDATE works SET title='$title', categories='$categories', photo='$fileName' WHERE id='$id_user'");
    if ($queryUpdate) {
        header("location:?page=works&ubah=berhasil");
    }

}


?>



<form action="" method="post">

    <div class="mb-3 row">
        <div class="col-sm-2">
            <label for="" class="form-label">Title</label>
        </div>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="title"
                value="<?= isset($_GET['edit']) ? $rowEdit['title'] : "" ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-2">
            <label for="" class="form-label">Kategori</label>
        </div>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="categories"
                value="<?= isset($_GET['edit']) ? $rowEdit['categories'] : "" ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <!-- <div class="col-sm-2"> -->
            <label for="" class="form-label mt-2">Photo</label>
            <input type="file" class="form-control" name="photo">
            <img src="uploads/<?php echo ($rowEdit['photo']) ?>" alt="" width="150">
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-primary"
                name="<?= isset($_GET['edit']) ? 'edit' : 'simpan' ?>">Simpan</button>
        </div>
    </div>
</form>