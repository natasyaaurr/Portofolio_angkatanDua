<?php
if ($_SESSION['LEVEL'] != 1) {
    //    echo "<h1>Access Denied</h1>";
//     echo "<p>You do not have permission to view this page.</p>";
//     echo "<a href='dashboard.php' class='btn btn-warning' >Go back to home</a>";
//     die;
    header("location:?page=education&failed=access");
}

if (isset($_POST['simpan'])) {
    $nama_sekolah = $_POST['nama_sekolah'];
    $tahun_lulus = $_POST['tahun_lulus'];
    $jurusan = $_POST['jurusan'];
    $query = mysqli_query($config, "INSERT INTO education (nama_sekolah,tahun_lulus,jurusan) VALUES ('$nama_sekolah','$tahun_lulus','$jurusan')");
    if ($query) {
        header("location:?page=education&tambah=berhasil");
    }

}

$header = isset($_GET['edit']) ? "Edit" : "Tambah";
$id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM education WHERE id='$id_user'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['edit'])) {
    $nama_sekolah = $_POST['nama_sekolah'];
    $tahun_lulus = $_POST['tahun_lulus'];
    $jurusan = $_POST['jurusan'];
    $pekerjaan = $_POST['pekerjaan'];


    $queryUpdate = mysqli_query($config, "UPDATE education SET nama_sekolah='$nama_sekolah', tahun_lulus='$tahun_lulus', jurusan='$jurusan' WHERE id='$id_user'");
    if ($queryUpdate) {
        header("location:?page=education&ubah=berhasil");
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
            <label for="name" class="form-label">Nama Sekolah*</label>
        </div>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" required
                value="<?= isset($_GET['edit']) ? $rowEdit['nama_sekolah'] : "" ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-2">
            <label for="tahun_lulus" class="form-label">Tahun Kelulusan *</label>
        </div>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="tahun_lulus" name="tahun_lulus" required
                value="<?= isset($_GET['edit']) ? $rowEdit['tahun_lulus'] : "" ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-2">
            <label for="" class="form-label">Jurusan</label>
        </div>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="jurusan" name="jurusan"
                value="<?= isset($_GET['edit']) ? $rowEdit['jurusan'] : "" ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-primary"
                name="<?= isset($_GET['edit']) ? 'edit' : 'simpan' ?>">Simpan</button>
        </div>
    </div>
</form>