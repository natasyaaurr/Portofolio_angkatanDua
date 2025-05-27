<?php
include 'config/koneksi.php';

if ($_SESSION['LEVEL'] != 1) {
    //    echo "<h1>Access Denied</h1>";
//     echo "<p>You do not have permission to view this page.</p>";
//     echo "<a href='dashboard.php' class='btn btn-warning' >Go back to home</a>";
//     die;
    header("location:?page=experience&failed=access");
}

$query = mysqli_query($config, "SELECT * FROM experience ORDER BY id DESC");
$row = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $queryDelete = mysqli_query($config, "DELETE FROM experience WHERE id='$id'");
    header("location:?page=experience&hapus=berhasil");
}
?>

<div class="table-responsive">
    <div align="right" class="mb-3">
        <a href="?page=manage-experience" class="btn btn-primary">Tambah experience</a>
    </div>
    <table class="table table-bordered table-striped" id="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Perusahaan</th>
                <th scope="col">Profesion</th>
                <th scope="col">Masa</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($row as $key => $data): ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $data['comp_name'] ?></td>
                    <td><?= $data['profesion'] ?></td>
                    <td><?= $data['waktu'] ?></td>
                    <td><?= $data['pekerjaan'] ?></td>
                    <td>
                        <a href="?page=manage-experience&edit=<?php echo $data['id'] ?>" class="btn btn-success">Edit</a>
                        <a onclick="return confirm('Yakin ingin menghapus data ini?')"
                            href="? page=experience&delete=<?php echo $data['id'] ?>" class="btn btn-warning">Hapus</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>