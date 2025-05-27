<?php
$query = mysqli_query($config, "SELECT * FROM about");
$row = mysqli_fetch_assoc($query); 
    if (isset($_GET['edit'])) {
    $idEdit = $_GET['edit'];
    $queryEdit = mysqli_query($config, "SELECT * FROM about WHERE id='$idEdit'");
    $row = mysqli_fetch_assoc($queryEdit);
    if ($row) {
        $name = $_POST['name'];
        $content = $_POST['content'];
        $status = $_POST['status'];

        $updateQ = mysqli_query($config, "UPDATE about SET name='$name', status='$status', content='$content' WHERE id='$idEdit'");
        header("location: ?page=myprofile&edit=berhasil");
    }
}

    if (isset($_GET['simpan'])) {
         if ($_GET['simpan'] == 'berhasil') {
        echo "<script>alert('Berhasil Menyimpan Data')</script>";
         }
}
?>



<form action="" method="post" enctype="multipart/form-data">
    <div class="m-2" style="width: 55% ;">
        <label for="" class="form-label">Name</label>
        <input type="text" value="<?php echo $row['name']; ?>" class="form-control"
            name="name">    

        <label for="" class="form-label mt-2">Content</label>
        <textarea class="form-control" name="content" cols="30" rows="5"
            id=""><?php echo $row['content']; ?></textarea>

        <label for="" class="form-label mt-2">Photo</label>
        <input type="file" class="form-control" name="photo">
        <img src="uploads/<?php echo ($row['photo']) ?>" alt="" width="150">
        <br>
        <label for="" class="mt-2">Status</label>
        <input type="radio" value="1" name="status" checked>Publish
        <input type="radio" value="0" name="status">Draft
        <br>
        <br>
        <br>
        <?php
        if (empty($row['name'])) {
            ?>

            <button type="submit" class="btn btn-primary mt-2" name="simpan">Simpan</button>

            <?php
        }
        ?>
    </div>
</form>