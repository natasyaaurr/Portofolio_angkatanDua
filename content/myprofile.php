<?php
include "config/koneksi.php";
if (isset($_POST['simpan'])) {
    $name = $_POST['name'];
    $content = $_POST['content'];
    $photo = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    $fileName = uniqid() . "_" . basename($photo);
    $filePath = "uploads/" . $fileName;
    // var_dump($photo);
    // mencari apakah di dalam tabel about sudah ada data atau belum , jika sudah ada maka lakukan update, jika belum ada maka lakukan insert
    //mysqli_num_rows() digunakan untuk pengecekan ada tidaknya data di dalam tabel
    $queryAbout = mysqli_query($config, "SELECT * FROM about ORDER BY id DESC");
    if (mysqli_num_rows($queryAbout) > 0) {
        // jika sudah ada data di dalam tabel about maka lakukan update
        $rowProfile = mysqli_fetch_assoc($queryAbout);
        $id = $rowProfile['id'];
        // jika user mengupload gambar
        if (!empty($photo)) {
            // jika ada foto yang diupload maka lakukan update dengan foto
            unlink("uploads/" . $rowProfile['photo']); // hapus foto lama
            move_uploaded_file($tmp_name, $filePath);
            $updateQ = mysqli_query($config, "UPDATE about SET name='$name', content='$content', photo='$fileName' WHERE id='$id'");
            header("location: ?page=myprofile&edit=berhasil");
        } else {
            // jika tidak ada foto yang diupload maka lakukan update tanpa foto
            $updateQ = mysqli_query($config, "UPDATE about SET name='$name', content='$content' WHERE id='$id'");
            header("location: ?page=myprofile&edit=berhasil");
        }

    } else {
        // jika belum ada data di dalam tabel about maka lakukan insert
        if (!empty($photo)) {
            // jika ada foto yang diupload maka lakukan insert dengan foto
            move_uploaded_file($tmp_name, $filePath);
             $insertQ = mysqli_query($config, "INSERT INTO about (name, content,photo) VALUES ('$name', '$content', '$fileName')");
            header("location: ?page=myprofile&tambah=berhasil");
        } else {
            // jika tidak ada foto yang diupload maka lakukan insert tanpa foto
            $insertQ = mysqli_query($config, "INSERT INTO about (name, content) VALUES ('$name', '$content')");
            header("location: ?page=myprofile&tambah=berhasil");
        }
    }

    $ekstensi = [
        'jpg',
        'jpeg',
        'png'
    ];
    // apakah user mengupload gambar sesuai dengan ekstensi yang diizinkan, jika iya maka lanjutkan proses upload ke dalam tabel about dan folder uploads
    // jika tidak maka tampilkan pesan error
    // $ext = pathinfo($photo, PATHINFO_EXTENSION);
    // if (!in_array($ext, $ekstensi)) {
    //     echo "<script>alert('Ekstensi tidak diizinkan')</script>";
    // } else {
    //     $insertQ = mysqli_query($config, "INSERT INTO about (name, content, photo) VALUES ('$name', '$content','$fileName' )");
    //     if ($insertQ) {
    //         header("location: ?page=myprofile&simpan=berhasil");
    //     }
    // }


    // if ($photo['error'] == 0) {
    //     $fileName = uniqid() . "_" . basename($photo['name']);
    //     $filePath = "uploads/" . $fileName;
    //     move_uploaded_file($photo['tmp_name'], $filePath);
    //     $insertQ = mysqli_query($config, "  INSERT INTO about (name, content, photo) VALUES ('$name', '$content','$fileName' )");
    // }


}
$selectProfile = mysqli_query($config, "SELECT * FROM about");
$row = mysqli_fetch_assoc($selectProfile);

?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="m-2" style="width: 55% ;">
        <div class="mb-3">
            <label for="" class="form-label">Name</label>
            <input type="text" value="<?php echo isset($row['name']) ? $row['name'] : '' ?>" class="form-control"
                name="name">
        </div>
        <div class="mb-3">
            <label for="" class="form-label mt-2">Content</label>
            <textarea class="form-control" name="content" cols="30" rows="5"
                id="summernote"><?php echo !isset($row['content']) ? '' : $row['content'] ?></textarea>
        </div>
        <div class="mb-3">
            <label for="" class="form-label mt-2">Photo</label>
            <input type="file" class="form-control" name="photo">
            <img src="uploads/<?php echo ($row['photo']) ?>" alt="" width="150">
        </div>
        <br>
        <button type="submit" class="btn btn-primary mt-2" name="simpan">Simpan</button>
    </div>
</form>