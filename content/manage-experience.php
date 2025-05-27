<?php
if ($_SESSION['LEVEL'] != 1) {
    //    echo "<h1>Access Denied</h1>";
//     echo "<p>You do not have permission to view this page.</p>";
//     echo "<a href='dashboard.php' class='btn btn-warning' >Go back to home</a>";
//     die;
    header("location:?page=experience&failed=access");
}

if (isset($_POST['simpan'])) {
    $comp_name = $_POST['comp_name'];
    $profesion = $_POST['profesion'];
    $waktu = $_POST['waktu'];
    $pekerjaan = $_POST['pekerjaan'];
    $query = mysqli_query($config, "INSERT INTO experience (comp_name,profesion,waktu,pekerjaan) VALUES ('$comp_name','$profesion','$waktu','$pekerjaan')");
    if ($query) {
        header("location:?page=experience&tambah=berhasil");
    }

}

$header = isset($_GET['edit']) ? "Edit" : "Tambah";
$id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM experience WHERE id='$id_user'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['edit'])) {
    $comp_name = $_POST['comp_name'];
    $profesion = $_POST['profesion'];
    $waktu = $_POST['waktu'];
    $pekerjaan = $_POST['pekerjaan'];


    $queryUpdate = mysqli_query($config, "UPDATE experience SET comp_name='$comp_name', profesion='$profesion', waktu='$waktu', pekerjaan='$pekerjaan' WHERE id='$id_user'");
    if ($queryUpdate) {
        header("location:?page=experience&ubah=berhasil");
    }

}

// $queryLevel = mysqli_query($config, "SELECT * FROM levels ORDER BY id DESC");
// $rowLevel = mysqli_fetch_all($queryLevel, MYSQLI_ASSOC); {
//     // $selected = isset($_GET['edit']) && $rowEdit['id_level'] == $rowLevel['id'] ? 'selected' : '';
// // echo "<option value='{$rowLevel['id']}' $selected>{$rowLevel['name_level']}</option>";

?>



<form action="" method="post">

    <div class="mb-3 row">
        <div class="col-sm-2">
            <label for="name" class="form-label">Nama Perusahaan*</label>
        </div>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="comp_name" name="comp_name" required
                value="<?= isset($_GET['edit']) ? $rowEdit['comp_name'] : "" ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-2">
            <label for="profesion" class="form-label">profesion *</label>
        </div>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="profesion" name="profesion" required
                value="<?= isset($_GET['edit']) ? $rowEdit['profesion'] : "" ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-2">
            <label for="" class="form-label">Masa Bekerja *</label>
        </div>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="waktu" name="waktu" required
                value="<?= isset($_GET['edit']) ? $rowEdit['waktu'] : "" ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-2">
            <label for="" class="form-label">Pekerjaan *</label>
        </div>
        <div class="col-sm-10">
            <textarea type="text" class="form-control" id="summernote" name="pekerjaan" required
                value="<?= isset($_GET['pekerjaan']) ? $rowEdit['pekerjaan'] : "" ?>"><?php echo !isset($rowEdit['pekerjaan']) ? '' : $rowEdit['pekerjaan'] ?></textarea>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-primary"
                name="<?= isset($_GET['edit']) ? 'edit' : 'simpan' ?>">Simpan</button>
        </div>
    </div>
</form>