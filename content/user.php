<?php
include 'config/koneksi.php';

if ($_SESSION['LEVEL'] != 1) {
    //    echo "<h1>Access Denied</h1>";
//     echo "<p>You do not have permission to view this page.</p>";
//     echo "<a href='dashboard.php' class='btn btn-warning' >Go back to home</a>";
//     die;
    header("location:dashboard.php?failed=access");
}

$query = mysqli_query($config, "SELECT levels.name_level, users.* FROM users 
LEFT JOIN levels ON levels.id = users.id_level ORDER BY users.id DESC");
$row = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $queryDelete = mysqli_query($config, "DELETE FROM users WHERE id='$id'");
    header("location:?page=user&hapus=berhasil");
}
?>

<div class="table-responsive">
    <div align="right" class="mb-3">
        <a href="?page=tambah-user" class="btn btn-primary">Tambah User</a>
    </div>
    <table class="table table-bordered table-striped" id="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama level</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($row as $key => $data): ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $data['name_level'] ?></td>
                    <td><?= $data['name'] ?></td>
                    <td><?= $data['email'] ?></td>
                    <td>
                        <a href="?page=tambah-user&edit=<?php echo $data['id'] ?>" class="btn btn-success">Edit</a>
                        <a onclick="return confirm('Yakin ingin menghapus data ini?')" href="user.php?delete="
                            class="btn btn-warning">Hapus</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>