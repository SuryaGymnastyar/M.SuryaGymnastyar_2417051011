<?php
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $npm = mysqli_real_escape_string($conn, $_POST['npm']);
    mysqli_query($conn, "INSERT INTO mahasiswa (nama, npm) VALUES ('$nama', '$npm')");
    header("Location: index.php");
    exit;
}

if (isset($_POST['update'])) {
    $id = (int) $_POST['id'];
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $npm = mysqli_real_escape_string($conn, $_POST['npm']);
    mysqli_query($conn, "UPDATE mahasiswa SET nama='$nama', npm='$npm' WHERE id=$id");
    header("Location: index.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id=$id");
    header("Location: index.php");
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head><title>CRUD Mahasiswa</title></head>
<body>
<h2>Data Mahasiswa</h2>

<form method="POST">
    <p>ID (Isi jika ingin Update): <input type="number" name="id" placeholder="ID"></p>
    <p>Nama: <input type="text" name="nama" required></p>
    <p>NPM: <input type="text" name="npm" required></p>
    <button type="submit" name="tambah">Tambah Baru</button>
    <button type="submit" name="update" style="background-color: orange;">Update by ID</button>
</form>
<br>

<table border="1" cellpadding="5">
    <tr><th>ID</th><th>Nama</th><th>NPM</th><th>Aksi</th></tr>
    <?php while($row = mysqli_fetch_assoc($data)): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['nama']) ?></td>
        <td><?= htmlspecialchars($row['npm']) ?></td>
        <td><a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a></td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
