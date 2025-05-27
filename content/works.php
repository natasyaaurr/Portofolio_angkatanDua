<?php
include 'config/koneksi.php';

if ($_SESSION['LEVEL'] != 1) {
    //    echo "<h1>Access Denied</h1>";
//     echo "<p>You do not have permission to view this page.</p>";
//     echo "<a href='dashboard.php' class='btn btn-warning' >Go back to home</a>";
//     die;
    header("location:?page=works&failed=access");
}

$query = mysqli_query($config, "SELECT* FROM works ORDER BY id DESC");
$row = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $queryDelete = mysqli_query($config, "DELETE FROM works WHERE id='$id'");
    header("location:?page=works&hapus=berhasil");
}
?>

<div class="table-responsive">
    <div align="right" class="mb-3">
        <a href="?page=manage-works" class="btn btn-primary">Tambah Portofolio</a>
    </div>
    <table class="table table-bordered table-striped" id="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Title</th>
                <th scope="col">Kategori</th>
                <th scope="col">Photo</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($row as $key => $data): ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $data['title'] ?></td>
                    <td><?= $data['categories'] ?></td>
                    <td><?= $data['photo'] ?></td>
                    <td>
                        <a href="?page=manage-works&edit=<?php echo $data['id'] ?>" class="btn btn-success">Edit</a>
                        <a onclick="return confirm('Yakin ingin menghapus data ini?')" href="?page=works&delete="
                            class="btn btn-warning">Hapus</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>