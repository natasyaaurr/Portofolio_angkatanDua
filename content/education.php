<?php
include 'config/koneksi.php';

if ($_SESSION['LEVEL'] != 1) {
    //    echo "<h1>Access Denied</h1>";
//     echo "<p>You do not have permission to view this page.</p>";
//     echo "<a href='dashboard.php' class='btn btn-warning' >Go back to home</a>";
//     die;
    header("location:?page=education&failed=access");
}

$query = mysqli_query($config, "SELECT * FROM education ORDER BY id DESC");
$row = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $queryDelete = mysqli_query($config, "DELETE FROM education WHERE id='$id'");
    header("location:?page=education&hapus=berhasil");
}
?>

<div class="table-responsive">
    <div align="right" class="mb-3">
        <a href="?page=manage-education" class="btn btn-primary">Tambah education</a>
    </div>
    <table class="table table-bordered table-striped" id="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Institut / Sekolah</th>
                <th scope="col">Tahun Lulus</th>
                <th scope="col">Jurusan</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($row as $key => $data): ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $data['nama_sekolah'] ?></td>
                    <td><?= $data['tahun_lulus'] ?></td>
                    <td><?= $data['jurusan'] ?></td>
                    <td>
                        <a href="?page=manage-education&edit=<?php echo $data['id'] ?>" class="btn btn-success">Edit</a>
                        <a onclick="return confirm('Yakin ingin menghapus data ini?')"
                            href="? page=education&delete=<?php echo $data['id'] ?>" class="btn btn-warning">Hapus</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>