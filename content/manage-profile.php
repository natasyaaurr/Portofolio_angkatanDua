<?php
include "config/koneksi.php";
if (isset($_POST['simpan'])) {
    $profile_name = $_POST['profile_name'];
    $profesion = $_POST['profesion'];
    $description = $_POST['description'];
    $photo = $_FILES['photo'];
    // var_dump($photo);

    if ($photo['error'] == 0) {
        $fileName = uniqid() . "_" . basename($photo['name']);
        $filePath = "uploads/" . $fileName;
        move_uploaded_file($photo['tmp_name'], $filePath);
        $insertQ = mysqli_query($config, "  INSERT INTO profiles (profile_name, profesion, description, photo) VALUES ('$profile_name','$profesion','$description','$fileName' )");
    }

    if ($insertQ) {
        //     header("location:dashboard.php?role=" . base64_encode($_SESSION['role']) . "&page=manage-profile");
        // }
    }
    $selectProfile = mysqli_query($config, "SELECT * FROM profiles");
    $row = mysqli_fetch_assoc($selectProfile);

    if (isset($_GET['del'])) {
        $idDel = $_GET['del'];

        $selectPhoto = mysqli_query($config, "SELECT photo FROM profiles WHERE id=$idDel");
        $rowPhoto = mysqli_fetch_assoc($selectPhoto);
        unlink("uploads/" . $row['photo']);
        $delete = mysqli_query($config, "DELETE FROM profiles WHERE id=$idDel");
        if ($delete) {

        }
    }
}
?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="m-2" style="width: 55% ;">
        <label for="" class="form-label">Profil Name</label>
        <input type="text" value="<?php echo !isset($row['profile_name']) ? '' : $row['profile_name'] ?>"
            class="form-control" name="profile_name">

        <label for="" class="form-label mt-2">Profesion</label>
        <input type="text" value="<?php echo !isset($row['profesion']) ? '' : $row['profesion'] ?>" class="form-control"
            name="profesion">

        <label for="" class="form-label mt-2">Description</label>
        <textarea class="form-control" name="description" cols="30" rows="5"
            id=""><?php echo !isset($row['description']) ? '' : $row['description'] ?></textarea>

        <label for="" class="form-label mt-2">Photo</label>
        <input type="file" class="form-control" name="photo">
        <img src="uploads/<?php echo ($row['photo']) ?>" alt="" width="150">
        <br>
        <?php
        if (empty($row['profile_name'])) {
            ?>

            <button type="submit" class="btn btn-primary mt-2" name="simpan">Simpan</button>

            <?php
        } else {
            ?>
            <a onclick="return confirm('YAKIN INGIN HAPUS??')"
                href=""
                class="btn btn-danger mt-2 " name="del"> Delete </a>
            <?php
        }
        ?>

    </div>
</form>